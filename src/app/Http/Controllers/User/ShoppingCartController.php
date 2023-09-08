<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

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
    public function index(): View
    {
        $total = 0;
        $productsInCart = [];
        $sessionProducts = session()->get('shopping_cart');
        if (!is_null($sessionProducts)) {

            $productsInCart = Product::findMany(array_keys($sessionProducts));
            $total = Product::sumPricesByQuantities($productsInCart, $sessionProducts);
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["table_header"] = ['Product','Price','Quantity','Total'];
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
    public function delete(Request $request):RedirectResponse
    {
        $request->session()->forget('products');
        return back();
    }
}