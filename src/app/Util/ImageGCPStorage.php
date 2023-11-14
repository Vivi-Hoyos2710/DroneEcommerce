<?php

declare(strict_types=1);

namespace App\Util;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\Request;

class ImageGCPStorage implements ImageStorage
{
    public function store(Request $request): string
    {
        if ($request->hasFile('image')) {
            $gcpKeyFile = file_get_contents(env('SERVICE_ACCOUNT_PATH'));

            $storage = new StorageClient(['keyFile' => json_decode($gcpKeyFile, true)]);
            $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));
            $imageOriginalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $gcpImageName = $imageOriginalName.'-'.uniqid().'.'.$imageExtension;

            $bucket->upload(
                file_get_contents($request->file('image')->getRealPath()),
                [
                    'name' => $gcpImageName,
                ],
            );

            $publicPath = 'https://storage.googleapis.com/'.env('GOOGLE_CLOUD_STORAGE_BUCKET').'/'.$gcpImageName;

            return $publicPath;
        } else {
            return '';
        }

    }
}
