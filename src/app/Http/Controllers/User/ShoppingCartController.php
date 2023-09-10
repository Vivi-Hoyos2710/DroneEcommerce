<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShoppingCartController extends Controller
{
    /**
     * Made by Vivi.
     */
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["table_header"] = ['Product', 'Price', 'Quantity', 'Total'];
        $viewData['products'] = $productsInCart;
        $viewData['total'] = $total;

        return view('user.cart.index')->with('viewData', $viewData);
    }
    public function add(Request $request, $id): RedirectResponse
    {

        $products = $request->session()->get("products");
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);
        return redirect()->route('cart.index');
    }
    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');
        return back();
    }
    public function purchase(Request $request): View|RedirectResponse
    {
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $userId = Auth::user()->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotalAmount(0);
            $order->setAddress($request->input('address'));
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $total = $total + ($product->getPrice() * $quantity);
            }
            $order->setTotalAmount($total);
            $order->save();
            $newBalance = Auth::user()->getBalance()-$total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            //$request->session()->forget('products');

            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] = "Purchase Status";
            $viewData["order"] = $order->getId();
            return view('user.cart.orderSuccess')->with("viewData", $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }

}