<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /* Made by Vivi */

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'My Orders - Online Store';
        $viewData['subtitle'] = 'My Orders';
        $viewData['table_header'] = ['Product ID', 'Product Name', 'Price', 'Quantity'];
        $viewData['orders'] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();

        return view('user.order.index')->with('viewData', $viewData);
    }

    /**
     *  Get the location of the order.
     *  
     * @return \Illuminate\View\View
     */
    public function locate(): View
    {
        return view('user.order.locate');
    }
}
