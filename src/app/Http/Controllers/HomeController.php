<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use App\Models\Review;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('app.app_name') . ' index';

        $topReviewedProducts = Product::with('reviews')
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->limit(3)
            ->get();
        Product::averageRateProducts($topReviewedProducts);
        $viewData['products'] = $topReviewedProducts;
        return view('user.home.index')->with('viewData', $viewData);
    }
}
