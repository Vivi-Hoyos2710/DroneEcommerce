<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse as Redirect;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Reviews';
        $viewData['reviews'] = Review::with(['product', 'user'])->where('verified', false)->get();

        return view('admin.review.index')->with('viewData', $viewData);
    }

    public function accept(string $id): Redirect
    {
        $review = Review::findOrFail($id);
        $review->setVerified(true);
        $review->save();

        return redirect()->back()->with('success', 'Review accepted successfully.');
    }

    public function delete(string $id): Redirect
    {
        Review::destroy($id);

        return redirect()->back()->with('rejected', 'Review rejected and deleted successfully.');
    }
}
