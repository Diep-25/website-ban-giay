<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function uploadImage($file, $folder)
    {
        $random = Str::random(10);
        $imageName = time(). '-' . $random . '.' . $file->extension();
        $file->move(public_path($folder), $imageName);
        return $imageName;
    }
    public function deleteImage($pathImage)
    {
        if (file_exists($pathImage)) {
            @unlink($pathImage);
        }
    }
}
