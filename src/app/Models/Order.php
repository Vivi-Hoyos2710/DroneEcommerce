<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total_amount'] - int - contains the order total amount
     * $this->attributes['address'] - string - contains the order address
     * $this->attributes['user_id'] - int - contains the referenced user id
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated items
     */
    //Validation
    public static function validate($request): void
    {
        $request->validate([
            'total' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
    }

    //Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotalAmount(): int
    {
        return $this->attributes['total_amount'];
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function getUserId(): int
    {
        return $this->attributes['id'];
    }

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
    //ITEMS []
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): HasMany
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }

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
}
