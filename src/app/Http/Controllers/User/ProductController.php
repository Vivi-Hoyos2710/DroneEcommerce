<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products';
        $viewData['subtitle'] = 'List of products';
        $viewData['price_title'] = 'Price';
        $viewData['products'] = Product::with('reviews')->get();

        return view('user.product.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.product.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);

        // View titles
        $viewData['title'] = $product['name'].' - Online Store';
        $viewData['subtitle'] = $product['name'].' - Product information';
        $viewData['price_title'] = 'Price';
        $viewData['description_title'] = 'Description';
        $viewData['size_title'] = 'Size';
        $viewData['brand_title'] = 'Brand';
        $viewData['category_title'] = 'Category';
        $viewData['name_title'] = 'Name';
        $viewData['count_title'] = 'Count';
        // cart
        $viewData['cart_title'] = 'Add to cart';

        // Product data
        $viewData['product'] = $product;

        return view('user.product.show')->with('viewData', $viewData);
    }
}
