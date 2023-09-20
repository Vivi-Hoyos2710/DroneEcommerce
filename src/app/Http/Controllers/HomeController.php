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
        $viewData['title'] = __('home.name').' index';

        $topReviewedProducts = Product::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->limit(3)
            ->get();

        $viewData['products'] = $topReviewedProducts;

        return view('user.home.index')->with('viewData', $viewData);
    }
}
