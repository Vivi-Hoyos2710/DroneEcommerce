<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Order extends Model
{
    protected $fillable = [
        'total_amount',
        'address',
        'user_id',
        'user',
        'items',
    ];

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
    public static function validate(Request $request): void
    {
        $request->validate([
            'total_amount' => 'required|numeric',
            'address' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
    }

    public static function validateDates(Request $request): void
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
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
        return $this->attributes['user_id'];
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
    public function setTotalAmount(int $total): void
    {
        $this->attributes['total_amount'] = $total;
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setUserId(int $id): void
    {
        $this->attributes['user_id'] = $id;
    }

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

    public function getItems(): Collection
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
