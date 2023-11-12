<?php

declare(strict_types=1);

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): string
    {
        $imageUrl = $request->file('image')->getClientOriginalName();
        if ($request->hasFile('image')) {
            Storage::disk('public')->put(
                $imageUrl,
                file_get_contents($request->file('image')->getRealPath()),
            );
            return 'storage/'.$imageUrl;
        }
        else{
            return '';
        }
    }
}
