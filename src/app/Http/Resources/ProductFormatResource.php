<?php

namespace App\Http\Resources;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReviewFormatResource;
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
        $average= Review::averageRating($reviews);
       
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'brand' => $this->getBrand(),
            'price' => $this->getPrice(),
            'size' => $this->getSize(),
            'description' => $this->getDescription(),
            'category'=> $this->getCategory(),
            'reviews'=> ['Average_rating'=>$average,'data'=>ReviewFormatResource::collection($reviews)],

        ];
    }
    public function byVerified($review){
        return $review->getVerified();
    }
}