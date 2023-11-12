<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DroneResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = ProductFormatResource::collection($this->collection);

        return [
            'data' => $data,
            'storeInfo' => [
                'name' => 'DroneStore',
                'storeProductsLink' => 'http://127.0.0.1:8000/products',
            ],
        ];

    }
}
