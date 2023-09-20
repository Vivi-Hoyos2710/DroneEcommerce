<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'My Orders - Online Store';
        $viewData['subtitle'] = 'My Orders';
        $viewData['table_header'] = ['Product ID', 'Product Name', 'Price', 'Quantity'];
        $viewData['orders'] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();

        return view('user.order.index')->with('viewData', $viewData);
    }

    public function filterDate(Request $request): View
    {
        Order::validateDates($request);
        $startDate = Carbon::parse($request->input('start'));
        $endDate = Carbon::parse($request->input('end'));
        $viewData = [];
        $viewData['table_header'] = [__('order.product_id'), __('order.product_name'), __('order.price'), __('order.quantity')];
        $viewData['orders'] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();

        return view('user.order.index')->with('viewData', $viewData);
    }

    public function locate(): View
    {
        return view('user.order.locate');
    }
}
