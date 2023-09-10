<?php

namespace App\Http\Controllers\Admin;


use App\Interfaces\ImageStorage;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\AdminProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse as Redirect;   


class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
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
     *
     * @return View
     */
    public function create(): View
    {   

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminProductRequest  $request
     * @return Redirect
     */
    public function store(AdminProductRequest $request): Redirect
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminProductRequest  $request
     * @param  int  $id
     * @return Redirect
     */
    public function update(AdminProductRequest $request, int $id): Redirect
    {

    }



}