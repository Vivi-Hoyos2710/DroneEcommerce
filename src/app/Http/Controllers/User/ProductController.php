<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\WishList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::with('reviews')->get();
        return view('user.product.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return view('user.product.create');
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];

        try {
            $product = Product::with('reviews')->findOrFail($id);
            $viewData['title'] = $product['name'].' - Online Store';
            $viewData['subtitle'] = $product['name'].' - Product information';
            $viewData['product'] = $product;
            $viewData['reviews'] = Review::where('product_id', $id)->where('verified', true)->get();
            $viewData['stars'] = Review::countRatingsByStars($viewData['reviews']);
            $viewData['total_review_count'] = count($viewData['reviews']);
            $viewData['average_rating'] = $viewData['reviews']->avg('rating');

            return view('user.product.show')->with('viewData', $viewData);
        } catch (Throwable $th) {
            return redirect()->route('product.index');

        }

    }

    public function searchProducts(Request $request): View
    {
        $search = $request->input('search');
        $viewData = [];
        $viewData['subtitle'] = 'Search results of: '.$search;
        $viewData['products'] = Product::where('name', 'LIKE', '%'.$search.'%')->latest()->paginate(15);

        return view('user.product.index')->with('viewData', $viewData);
    }

    public function deleteReview(string $id): RedirectResponse
    {
        Review::destroy($id);

        return redirect()->route('product.index')->with('delete', 'Eliminada review con id #'.$id);
    }

    public function saveReview(Request $request, $productId)
    {
        Review::validate($request);

        $review = new Review();

        $stringToIntRating = (int) $request->input('rating');
        $review->setRating($stringToIntRating);

        $review->setDescription($request->input('description'));
        $review->setVerified(false);

        $user = Auth::user();
        $review->setUserId($user->getId());

        $stringToIntProductId = intval($productId);
        $review->setProductId($stringToIntProductId);

        $review->save();

        return redirect()->back();
    }

    public function saveWishList($productId)
    {
        $user = Auth::user();
        if (! $user->getWishList()) {
            $wishList = new WishList();
            $wishList->setUserId($user->getId());
            $wishList->save();
            $wishList->products()->attach($productId);
        } else {
            $wishList = $user->getWishList();
            if (! $wishList->getProducts()->contains($productId)) {
                $wishList->products()->attach($productId);
            }
        }

        return redirect()->back();
    }

    public function calculator(): View
    {
        $viewData = [];
        $viewData['title'] = 'Calculator';
        $viewData['subtitle'] = 'Drone range calculator';

        return view('user.product.calculator')->with('viewData', $viewData);
    }
}
