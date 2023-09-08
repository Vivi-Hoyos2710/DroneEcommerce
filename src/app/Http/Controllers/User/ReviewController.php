<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData = []; 
        $viewData['title'] = __('review.name').' index'; 
        $viewData['reviews'] = Review::all();

        return view('user.product.show')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $viewData = []; 
        $viewData['title'] = 'Create product';
        $viewData['reviews'] = Review::all();
        
        return view('user.product.show')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['description'] = $request['description'];
        $viewData['rating'] = $request['rating'];

        Review::create($request->only(['description', 'rating']));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): void
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review): void
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review): void
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Review::destroy($id);
        return redirect()->route('user.review.list')->with('delete', 'Eliminada review con id #'.$id);
    }

}
