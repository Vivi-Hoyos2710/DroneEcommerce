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
        $viewData['title'] = 'Products';
        $viewData['subtitle'] = 'List of products';
        $viewData['price_title'] = 'Price';
        $viewData['empty_message'] = 'No products';
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
            $viewData['title'] = $product['name'] . ' - Online Store';
            $viewData['subtitle'] = $product['name'] . ' - Product information';
            $viewData['price_title'] = 'Price';
            $viewData['description_title'] = 'Description';
            $viewData['size_title'] = 'Size';
            $viewData['brand_title'] = 'Brand';
            $viewData['category_title'] = 'Category';
            $viewData['name_title'] = 'Name';
            $viewData['count_title'] = 'Count';
            $viewData['cart_title'] = 'Add to cart';
            $viewData['review_title_comment'] = 'Leave us your opinion!';
            $viewData['product'] = $product;
            $viewData['reviews'] = Review::where('product_id', $id)->where('verified', true)->get();

            return view('user.product.show')->with('viewData', $viewData);
        } catch (Throwable $th) {
            return redirect()->route('product.index');

        }

    }

    public function searchProducts(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = 'Products';
        $viewData['subtitle'] = 'Search results';
        $viewData['price_title'] = 'Price';
        $viewData['empty_message'] = 'No products match the query';
        $viewData['products'] = Product::where('name', 'LIKE', '%' . $request->input('search') . '%')->latest()->paginate(15);
        
        return view('user.product.index')->with('viewData', $viewData);
    }
    public function deleteReview(string $id): RedirectResponse
    {
        Review::destroy($id);

        return redirect()->route('product.index')->with('delete', 'Eliminada review con id #' . $id);
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
        if (!$user->getWishList()) {
            $wishList = new WishList();
            $wishList->setUserId($user->getId());
            $wishList->save();
            $wishList->products()->attach($productId);
        } else {
            $wishList = $user->getWishList();
            if (!$wishList->getProducts()->contains($productId)) {
                $wishList->products()->attach($productId);
            }
            //dd($wishList->getProducts());
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