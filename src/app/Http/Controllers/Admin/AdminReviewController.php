<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse as Redirect;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData = [
            'title' => 'Reviews',
        ];
        $products = Product::all();

        return view('admin.review.index', compact('products'), compact('viewData'));
    }

    public function accept($id)
    {
        $review = Review::findOrFail($id);
        $review->verified = 1;
        $review->save();

        return redirect()->back()->with('success', 'Review accepted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirect
     */
    public function delete($id)
    {
        Review::destroy($id);

        return redirect()->back()->with('rejected', 'Review rejected and deleted successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductRequest $request): Redirect
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProductRequest $request, int $id): Redirect
    {

    }
}
