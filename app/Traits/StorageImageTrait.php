<?php 
namespace App\Traits;

trait StorageImageTrait {
    public function uploadImage($file , $folder)
    {
            $imageName = time().'.'.$file->extension();
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