<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DroneResource;
use App\Http\Resources\ProductFormatResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProductController extends Controller
{
    public function allProducts(): JsonResponse
    {
        $products = new DroneResource(Product::all());

        return response()->json($products, 200);
    }

    public function allAccessories(): JsonResponse
    {
        $accesories = new DroneResource(Product::where('category', 'accessory')->get());

        return response()->json($accesories, 200);
    }

    public function allBases(): JsonResponse
    {
        $bases = new DroneResource(Product::where('category', 'base')->get());

        return response()->json($bases, 200);
    }

    public function productById(string $id): JsonResponse
    {
        try {

            $product = Product::findOrFail($id);
            $accesories = new ProductFormatResource($product);

            return response()->json($accesories, 200);
        } catch (Throwable $th) {
            dd($th);

            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
