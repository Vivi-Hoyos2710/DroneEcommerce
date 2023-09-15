<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishListController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = 'Cart - Online Store';
        //$viewData['wishList'] = WishList::where('user_id', Auth::user()->getId())->get();   
        $viewData['wishList'] = WishList::with('product')->where('user_id', Auth::user()->getId())->get();

        //$viewData['orders'] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();

        
        return view('user.wishList.index')->with('viewData', $viewData);
    }

}