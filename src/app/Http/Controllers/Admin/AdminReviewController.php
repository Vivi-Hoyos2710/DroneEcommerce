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
        $viewData['title'] = __('review.title');
        $viewData['reviewTitle'] = __('review.reviewTitle');
        $viewData['totalAccepted'] = Review::where('verified', true)->count();
        $viewData['totalRejected'] = Review::where('verified', false)->count();

        return view('admin.review.index')->with('viewData', $viewData);
    }

    public function acceptedReviews(): View
    {
        $viewData = [];
        $viewData['type'] = __('review.accepted');
        $viewData['title'] = 'Drone Admin - Reviews';
        $viewData['reviewTitle'] = __('review.reviewTitle');
        $viewData['reviews'] = Review::with(['product', 'user'])->where('verified', true)->get();

        return view('admin.review.list')->with('viewData', $viewData);
    }

    public function rejectedReviews(): View
    {
        $viewData = [];
        $viewData['type'] = __('review.rejected');
        $viewData['title'] = 'Drone Admin - Reviews';
        $viewData['reviewTitle'] = __('review.reviewTitle');

        $viewData['reviews'] = Review::with(['product', 'user'])->where('verified', false)->orderBy('created_at', 'asc')->get();

        return view('admin.review.list')->with('viewData', $viewData);
    }

    public function accept(string $id): Redirect
    {
        $viewData['reviewAccept'] = __('review.reviewAccept');
        $review = Review::findOrFail($id);
        $review->setVerified(true);
        $review->save();

        return redirect()->back()->with('success', $viewData['reviewAccept']);
    }

    public function reject(string $id): Redirect
    {
        $viewData['reviewReject'] = __('review.reviewReject');
        $review = Review::findOrFail($id);
        $review->setVerified(false);
        $review->save();

        return redirect()->back()->with('rejected', $viewData['reviewReject']);
    }

    public function delete(string $id): Redirect
    {
        $viewData['reviewReject'] = __('review.reviewReject');
        Review::destroy($id);

        return redirect()->back()->with('deleted', $viewData['reviewReject']);
    }
}
