<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ImageStorage;
use App\Models\Product;
use Illuminate\Http\RedirectResponse as Redirect;
use Illuminate\View\View;

class AdminProductController extends Controller
{
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

    public function create(): View
    {
        $viewData = [
            'title' => 'Create Product',
        ];

        return view('admin.product.create', compact('viewData'));
    }

    public function store(CreateProductRequest $request): Redirect
    {
        $product = new Product();

        $validated = $request->validated();

        $product->setName($validated['name']);
        $product->setPrice((int) $validated['price']);
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

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);
        $viewData = [
            'title' => 'Edit Product',
            'product' => $product,
        ];

        return view('admin.product.edit', compact('viewData'));
    }

    public function update(UpdateProductRequest $request, int $id): Redirect
    {

        $product = Product::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $storeInterface = app(ImageStorage::class);
            $storeInterface->store($request);
            $product->setImage($request->file('image')->getClientOriginalName());
        }

        if (isset($validated['name'])) {
            $product->setName($validated['name']);
        }

        if (isset($validated['price'])) {
            $product->setPrice((int) $validated['price']);
        }

        if (isset($validated['description'])) {
            $product->setDescription($validated['description']);
        }

        if (isset($validated['category'])) {
            $product->setCategory($validated['category']);
        }

        if (isset($validated['size'])) {
            $product->setSize($validated['size']);
        }

        if (isset($validated['brand'])) {
            $product->setBrand($validated['brand']);
        }

        $product->save();

        return redirect()->route('admin.products');
    }

    public function delete(int $id): Redirect
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products');
    }
}
