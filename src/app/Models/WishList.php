<?php

declare(strict_types=1);

namespace App\Models;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WishList extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     * $this->user - User - contains the associated User
     * $this->products - Product[] - contains the associated Products
     */

    //Getters
    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    //Setters

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
 
    //Relationships

    // PRODUCTS
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProducts(): Collection
    {
        return $this -> product;
    }

    public function setProducts(Collection $product): void
    {
        $this -> product = $product;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }



    // USER

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this -> user;
    }

    public function setUser(User $user): void
    {
        $this -> user = $user;
    }
}