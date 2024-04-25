<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadImage($image)
    {
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $fileName);

        return 'images/products/' . $fileName;
    }
}
