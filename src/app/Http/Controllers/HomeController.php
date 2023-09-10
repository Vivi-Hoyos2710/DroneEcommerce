<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('z.name').' index';

        $products = Product::whereHas('reviews')->get();

        return view('user.home.index', compact('products'))->with('viewData', $viewData);

        // $productsWithReviews = Product::whereHas('reviews')->get();

        // return view('home', compact('productsWithReviews'));
    }
}
