<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Review extends Model
{
    /** LIST OF ATRRIBUTES:
     * attributes['id'] : int  =>Id of the review
     * attributes['description'] : string  =>Description of the reviews
     * attributes['rating'] : int => Rating of the product (0-5)
     * attributes['verified'] : boolean => To verify before publishing the review
     * attributes['user_id'] : int => id of user that makes the review
     * attributes['product_id'] : int => id of product related to the review
     * attributes['created_at'] : string => Date of the creation of the review
     * attributes['updated_at'] : string => update of the review
     * $this->user - User - contains the associated User
     * $this->product - Product - contains the associated Product
     */
    //Getters

    protected $fillable = ['description', 'rating'];

    public static function countRatingsByStars(Collection $reviews): array
    {
        $listCount = [];
        foreach ($reviews as $review) {
            $rating = $review->getRating();
            if (! isset($listCount[$rating])) {
                $listCount[$rating] = 1;
            } else {
                $listCount[$rating]++;
            }
        }

        return $listCount;
    }

    public static function averageRating(Collection $reviews): float
    {
        $average = 0;

        $total = count($reviews);
        $sum = 0;
        foreach ($reviews as $review) {
            $sum = $sum + $review->getRating();
        }
        if ($total > 0) {
            $average = $sum / $total;
        }

        return $average;
    }

    public static function validate(Request $request): void
    {
        $request->validate([
            'description' => 'required|string|min:10|max:255',
            'rating' => 'required|numeric|between:0,5',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function getVerified(): bool
    {
        return (bool) $this->attributes['verified'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): int
    {
        return $this->attributes['updated_at'];
    }

    //Setters
    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function setVerified(bool $verified): void
    {
        $this->attributes['verified'] = $verified;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    //Relationships
    //USER
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    //Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
