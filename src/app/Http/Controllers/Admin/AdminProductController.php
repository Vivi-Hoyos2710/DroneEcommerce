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

        $viewData['title'] = 'Products';
        $viewData['table_header'] = [
            __('product.id'),
            __('product.name'),
            __('product.price'),
            __('product.description'),
            __('product.image'),
            __('product.category'),
            __('product.size'),
            __('product.brand'),
            __('product.delete'),
            __('product.edit'),
        ];
        $viewData['products'] = $products;

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData['title'] = 'Create Product';

        return view('admin.product.create')->with('viewData', $viewData);
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

        $storeInterface = app(ImageStorage::class, ['storage' => $validated['storage']]);
        $productPath = $storeInterface->store($request);

        $product->setImage($productPath);

        $product->save();

        return redirect()->route('admin.products');
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData['title'] = 'Edit Product';
        $viewData['product'] = $product;

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(UpdateProductRequest $request, int $id): Redirect
    {

        $product = Product::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $storeInterface = app(ImageStorage::class, ['storage' => $validated['storage']]);
            $productPath = $storeInterface->store($request);
            $product->setImage($productPath);
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
