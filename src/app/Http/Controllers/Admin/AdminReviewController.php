<?php

namespace App\Http\Controllers\Admin;


use App\Interfaces\ImageStorage;
use Illuminate\View\View;
use App\Models\Product;
use App\Http\Requests\AdminProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse as Redirect;   


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {   
        $products = Product::with('reviews')->get();
        $viewData = [
            'title' => 'Products',
            'table_header' => ['ID', 'Name', 'Price', 'Description', 'Image', 'Category', 'Size', 'Brand', 'Delete', 'Edit  '],
            'products' => $products,
        ];
        return view('admin.reviews.index', compact('viewData'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirect
     */
    public function delete(int $id): Redirect {
    }

}