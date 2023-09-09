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
        return view('admin.product.index', compact('viewData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {   
        $viewData = [
            'title' => 'Create Product',
        ];
        return view('admin.product.create', compact('viewData'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminProductRequest  $request
     * @return Redirect
     */
    public function store(AdminProductRequest $request): Redirect
    {
        $product = new Product();

        $validated = $request->validated();

        $product->setName($validated['name']);
        $product->setPrice($validated['price']);
        $product->setDescription($validated['description']);
        $product->setCategory($validated['category']);
        $product->setSize($validated['size']);
        $product->setBrand($validated['brand']);

        // Store the image in the public folder
        $storeInterface = app(ImageStorage::class);
        $storeInterface->store($request);
        $product->setImage($request->file('image')->getClientOriginalName());

        $product->save();

        return redirect()->route('admin.products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {   
        $product = Product::findOrFail($id);
        $viewData = [
            'title' => 'Edit Product',
            'product' => $product,
        ];
        return view('admin.product.edit', compact('viewData'));
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


        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $storeInterface = app(ImageStorage::class);
            $storeInterface->store($request);
            $product->setImage($request->file('image')->getClientOriginalName());
        }

        if (isset($request['name'])) {
            $product->setName($request['name']);
        }

        if (isset($request['price'])) {
            $product->setPrice($request['price']);
        }

        if (isset($request['description'])) {
            $product->setDescription($request['description']);
        }

        if (isset($request['category'])) {
            $product->setCategory($request['category']);
        }

        if (isset($request['size'])) {
            $product->setSize($request['size']);
        }

        if (isset($request['brand'])) {
            $product->setBrand($request['brand']);
        }

        $product->save();


        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirect
     */
    public function delete(int $id): Redirect {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products');
    }

}
