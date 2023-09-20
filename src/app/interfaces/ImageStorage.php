<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageStorage
{
    public function store(Request $request): void;
}
