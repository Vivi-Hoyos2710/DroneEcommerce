<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** LIST OF PRODUCT ATRRIBUTES:
     * attributes['id'] : int  =>Id of the product
     * attributes['name'] : string  =>name of the product
     * attributes['brand'] : string => Brand of the product
     * attributes['price'] : float => Price of the product
     * attributes['size'] : enum['s', 'm','l'] =>
     * attributes['description'] : string => Description of the product
     * attributes['category'] : enum['accesory','base'] =>
     * attributes['image'] : string => Brand of the product
     * attributes['created_at'] : string => Date of the creation of the product
     * attributes['updated_at'] : string => update of the product
     * this->reviews - Review[] - contains the associated reviews
     * $this->items - Item[] - contains the associated items
     */
    public static function sumPricesByQuantities($products, $productsInSession): int
    {   
        
        $total = 0;
        foreach ($products as $product) {
            $total = $total + ($product->getPrice() * $productsInSession[$product->getId()]['quantity']);
        }

        return $total;
    }
   


    //Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getSize(): string
    {
        return $this->attributes['size'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function getCreatedAt(): DateTime
    {
        $date = new DateTime($this->attributes['created_at']);

        return $date;
    }

    public function getUpdatedAt(): DateTime
    {
        $date = new DateTime($this->attributes['updated_at']);

        return $date;
    }

    //Setters
    public function setName(string $name): void
    {
        $this->attributes['name'] = mb_strtolower($name);
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = mb_strtolower($brand);
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setSize(string $size): void
    {
        $this->attributes['size'] = $size;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    //RelationShips
    //Reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function setReviews(Collection $reviews): void
    {
        $this->reviews = $reviews;
    }

    //Items
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): void
    {
     
        $this->items = $items;
    }

    // WISHLIST
    public function wishlists(): BelongsToMany
    {
        return $this -> belongsToMany(WishList::class);
    }

    public function getWishlists(): Collection
    {
        return $this -> wishlists;
    }
    
    public function setWishlists(Collection $wishlists): void
    {
        $this -> wishlists = $wishlists;
    }
}
