<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishListController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $viewData = [];
        $viewData['title'] = 'Drone - WishList';

        $wishList = WishList::with('products')->where('user_id', Auth::user()->getId())->get()->first();
        if ($wishList) {
            $viewData['wishList'] = $wishList;
            $viewData['productToCart'] = __('wishList.productToCart');
            $viewData['deleteFromList'] = __('wishList.deleteFromList');

            return view('user.wishList.index')->with('viewData', $viewData);

        } else {

            return redirect()->back();
        }

    }

    public function delete(string $id, string $WishListId): RedirectResponse
    {
        $wishlist = WishList::find($WishListId);
        $wishlist->products()->detach($id);

        return redirect()->route('wishlist.index');
    }
}
