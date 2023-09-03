<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends Model
{
    //Relationships
    public function items(): HasMany
    {
        return $this->hasMany(Item::Class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
