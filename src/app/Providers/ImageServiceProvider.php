<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(ImageStorage::class, fn () => new ImageLocalStorage());
    }
}
