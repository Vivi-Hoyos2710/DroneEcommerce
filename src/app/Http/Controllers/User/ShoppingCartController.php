<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    /**
     * Made by Vivi.
     */
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }
        $viewData = [];
        $viewData['title'] = 'Cart - Online Store';
        $viewData['table_header'] = ['Product', 'Price', 'Quantity', 'Total'];
        $viewData['products'] = $productsInCart;
        $viewData['total'] = $total;

        return view('user.cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, $id): RedirectResponse
    {
        $products = $request->session()->get('products');
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
        $productsInSession = $request->session()->get('products');
        $total=0;
        $currentBalance=Auth::user()->getBalance();
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
            $userId = Auth::user()->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotalAmount($total);
            $order->setAddress($request->input('address'));
            $newBalance = $currentBalance - $total;
            
            if ($newBalance<0) {
                return redirect()->route('cart.index')->with('error', 'Not enough money to purchase');
            }
            
            $order->save();            
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $item = new Item();
                $item->setQuantity(intval($quantity));
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
            }              
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();
            $viewData = [];
            $viewData['title'] = 'Purchase - Online Store';
            $viewData['subtitle'] = 'Purchase Status';
            $viewData['order'] = $order->getId();
            $request->session()->forget('products');
            return view('user.cart.orderSuccess')->with('viewData', $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }
}
