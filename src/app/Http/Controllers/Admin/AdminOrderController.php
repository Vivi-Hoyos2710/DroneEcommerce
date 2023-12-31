<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('adminpanel.orders');
        $viewData['message'] = __('adminpanel.welcome');
        $viewData['table_header'] = [
            __('order.id'),
            __('order.total_amount'),
            __('order.address'),
            __('order.id_user'),
            __('order.customer_name'),
            __('order.date'),
            __('order.updated_at'),
            __('order.delete'),
            __('order.show'),
        ];
        $viewData['orders'] = Order::with('user')->get();

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function delete(string $id): RedirectResponse
    {
        Order::destroy($id);

        return redirect()->route('admin.orders')->with('delete', 'Deleted order id'.$id);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('adminpanel.orders').' Show';
        $viewData['order'] = Order::with('items')->findOrFail($id);

        return view('admin.order.show')->with('viewData', $viewData);
    }
}
