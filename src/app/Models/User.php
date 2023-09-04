<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
     * LIST OF ATTRIBUTES:
     * attributes['id'] : int => The user's unique ID
     * attributes['name'] : string => The user's name
     * attributes['email'] : string => The user's email address
     * attributes['email_verified_at'] : timestamp => The timestamp when the email was verified
     * attributes['password'] : string => The user's password (hashed)
     * attributes['remember_token'] : string => The user's remember token
     * attributes['created_at'] : timestamp => The date and time when the user account was created
     * attributes['updated_at'] : timestamp => The date and time when the user account was last updated
     * attributes['username'] : string => The user's username
     * attributes['rol'] : string (Possible values: 'admin', 'customer') => The user's role
     * attributes['balance'] : int => The user's account balance (integer)
     */
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
