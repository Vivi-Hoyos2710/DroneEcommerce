<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
class User extends Authenticatable
{
    /**
     * LIST OF ATTRIBUTES:
     * $this->attributes['id'] : int => The user's unique ID
     * $this->attributes['name'] : string => The user's name
     * $this->attributes['email'] : string => The user's email address
     * $this->attributes['email_verified_at'] : timestamp => The timestamp when the email was verified
     * $this->attributes['password'] : string => The user's password 
     * $this->attributes['remember_token'] : string => The user's remember token
     * $this->attributes['created_at'] : timestamp => The date and time when the user account was created
     * $this->attributes['updated_at'] : timestamp => The date and time when the user account was last updated
     * $this->attributes['username'] : string => The user's username
     * $this->attributes['rol'] : string (Possible values: 'admin', 'customer') => The user's role
     * $this->attributes['balance'] : int => The user's account balance (integer)
     * $this->orders - Order[] - contains the associated orders 
     * $this->orders - Review[] - contains the associated reviews 
     */
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'rol',
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
    //Getters and setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }
    public function getName():string
    {
        return $this->attributes['name'];
    }
    public function getEmail():string
    {
        return $this->attributes['email'];
    }
    public function getUserName():string
    {
        return $this->attributes['username'];
    }
    public function getPassword():string
    {
        return $this->attributes['password'];
    }
    public function getRol():string
    {
        return $this->attributes['rol'];
    }
    public function getBalance():int
    {
        return $this->attributes['balance'];
    }
    //setters
    public function setName(string $name)
    {
        $this->attributes['name'] = $name;
    }
    public function setUserName(string $name)
    {
        $this->attributes['username'] = $name;
    }
    public function setEmail(string $email)
    {
        $this->attributes['email'] = $email;
    }
    public function setPassword(string $password)
    {
        $this->attributes['password'] = $password;
    }
    public function setRole(string $role)
    {
        $this->attributes['role'] = $role;
    }
    public function setBalance(int $balance)
    {
        $this->attributes['balance'] = $balance;
    }
  
    // Relationships
    //REVIEWS
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function getReviews(): HasMany
    {
        return $this->reviews();
    }

    public function setReviews(HasMany $reviews)
    {
        $this->reviews = $reviews;
    }

    //ORDERS
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function getOrders(): HasMany
    {
        return $this->orders;
    }

    public function setOrders(HasMany $orders)
    {
        $this->orders = $orders;
    }

    //Validations of each field to custom update
    public static function validateEach(Request $request, string $type): string
    {
        if ($type == 'name' || $type == 'username') {
            $request->validate([
                $type => 'required|string|max:255',
            ]);
            
        } elseif ($type == 'email') {
            $request->validate([
                $type => 'required|string|email|max:255|unique:users',
            ]);

        } else {
            $request->validate([
                $type => 'required|string|min:8',
            ]);
        }

        return $type;
    }
}