<?php


declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductFormatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $reviews = $this->getReviews()->filter([$this, 'byVerified']);

        $average = Review::averageRating($reviews);


        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'brand' => $this->getBrand(),
            'price' => $this->getPrice(),
            'size' => $this->getSize(),

            'local_image' => '/storage/'.$this->getImage(),
            'description' => $this->getDescription(),
            'category' => $this->getCategory(),
            'reviews' => ['Average_rating' => $average, 'data' => ReviewFormatResource::collection($reviews)],

        ];
    }

    public function byVerified($review)
    {

        return $review->getVerified();
    }
}
