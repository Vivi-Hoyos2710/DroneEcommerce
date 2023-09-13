<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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
            $viewData['review_title_comment']='Leave us your opinion!';
            $viewData['product'] = $product;
            $viewData['reviews'] = Review::where('product_id', $id)->where('verified', true)->get();

            return view('user.product.show')->with('viewData', $viewData);
        } catch (Throwable $th) {
            return redirect()->route('product.index');

        }

    }
    //Search function by Viviana.
    public function searchProducts(Request $request):View
    {
        $viewData = [];
        $viewData['title'] = 'Products';
        $viewData['subtitle'] = 'Search results';
        $viewData['price_title'] = 'Price';
        $viewData['empty_message'] = 'No products match the query';
        $viewData['products'] = Product::where('name', 'LIKE', '%' . $request->input('search') . '%')->latest()->paginate(15);
        return view('user.product.index')->with('viewData', $viewData);
    }
    public function deleteReview(string $id):RedirectResponse
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
        $currentProducts = WishList::where('user_id', Auth::user()->getId())->with('products');

        $user = Auth::user() -> getId();
        $product = Product::find($productId);
        $wishList = new WishList();
        $wishList -> setUserId($user);

        if(!in_array($product, $currentProducts)){
            $currentProducts[] = $product;
        }

        $wishList -> setProducts($currentProducts);
        $wishList -> save();

        return redirect()->back();
    }

    //Gepeto Help:
    //     public function saveWishList($productId)
    // {
    //     // Retrieve the user's wishlist as an array of products
    //     $currentProducts = WishList::where('user_id', Auth::user()->getId())
    //         ->with('products')
    //         ->first(); // Use 'first()' to execute the query and get the result

    //     $user = Auth::user()->getId();
    //     $product = Product::find($productId);

    //     // Create a new wishlist if it doesn't exist
    //     if (!$currentProducts) {
    //         $currentProducts = new WishList();
    //         $currentProducts->setUserId($user);
    //         $currentProducts->save();
    //     }

    //     // Check if the product is already in the wishlist
    //     if (!$currentProducts->products->contains($product->getId())) {
    //         // Add the product to the wishlist
    //         $currentProducts->products()->attach($product);
    //     }

    //     return redirect()->back();
    // }



    //by Julian David
    public function calculator(): View
    {

        $viewData = [];
        $viewData['title'] = 'Calculator';
        $viewData['subtitle'] = 'Drone range calculator';

        return view('user.product.calculator')->with('viewData', $viewData);
    }
}