<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        $viewData['table_header'] = ['Item ID', 'Product Name', 'Price', 'Quantity'];
        $viewData["orders"] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();
        return view('user.order.index')->with("viewData", $viewData);
    }

}