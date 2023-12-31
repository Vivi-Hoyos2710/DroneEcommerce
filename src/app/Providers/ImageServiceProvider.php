<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageGCPStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //aqui faltan tipos de $app $params
        $this->app->bind(ImageStorage::class, function ($app, $params) {
            $storage = $params['storage'];
            if ($storage === 'local') {
                return new ImageLocalStorage();
            } elseif ($storage === 'gcp') {
                return new ImageGCPStorage();
            }
        });
    }
}
