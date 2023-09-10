<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //si?
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Products";
        $viewData["subtitle"] = "List of products";
        $viewData["price_title"] = "Price";
        $viewData["products"] = Product::with('reviews')->get();
        return view('user.product.index')->with("viewData", $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): void
    {
    }

    /**
     * Display the specified resource.
     */

     //UTILIZAR GET Y SET
    public function show(string $id): View 
    {
        $viewData = [];
        $product = Product::findOrFail($id);

        // View titles
        $viewData["title"] = $product["name"] . " - Online Store";
        $viewData["subtitle"] = $product["name"] . " - Product information";
        $viewData["price_title"] = "Price";
        $viewData["description_title"] = "Description";
        $viewData["size_title"] = "Size";
        $viewData["brand_title"] = "Brand";
        $viewData["category_title"] = "Category";
        $viewData["name_title"] = "Name";
        // cart
        $viewData["cart_title"] = "Add to cart";

        // Product data
        $viewData["product"] = $product;

        // Reviews
        $viewData["reviews"] = Review::where('product_id', $id)->get();

        return view('user.product.show')->with("viewData", $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): void
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): void
    {
    }

    public function delete($id)
    {
        Review::destroy($id);

        return redirect()->route('product.index')->with('delete', 'Eliminada review con id #'.$id);
        //falta mostrar un mensaje de confirmacion
    }

    public function saveReview(Request $request, $productId)
    {
        // Create a new review instance with the validated data
        $review = new Review([
            'rating ' => $request->input('rating '),
            'description' => $request->input('description'),
        ]);
    
        // Associate the review with the current user
        $user = Auth::user();
        $review->user()->associate($user);
    
        // Associate the review with the product
        $product = Product::find($productId);
        $review->product()->associate($product);
    
        // Save the review to the database
        $review->save();
    
        // Redirect back
        return redirect()->back();
    }
}
