<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     */
    //Getters
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
        return $this->attributes['verified'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAtColumn(): int
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtColumn(): int
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

    public function setVerified(int $verified): void
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

    //RelationShips
    //USER
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): BelongsTo
    {
        return $this->user;
    }

    public function setUser(BelongsTo $user): void
    {
        $this->user = $user;
    }

    //Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product): void
    {
        $this->product = $product;
    }
}
