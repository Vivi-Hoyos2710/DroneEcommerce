<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $viewData["count_title"] = "Count";

        // Product data
        $viewData["product"] = $product;
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
}
