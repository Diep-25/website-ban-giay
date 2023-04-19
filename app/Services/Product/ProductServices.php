<?php

namespace App\Services\Product;

use App\Repository\Color\ColorRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\Size\SizeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\StorageImageTrait;

class ProductServices {
    use StorageImageTrait;
    private $productRepository;
    private $colorRepository;
    private $sizeRepository;
    public function __construct(
        ProductRepository $productRepository , 
        ColorRepository $colorRepository ,
        SizeRepository $sizeRepository
        ) 
    {
        $this->productRepository = $productRepository; 
        $this->colorRepository = $colorRepository; 
        $this->sizeRepository = $sizeRepository;   
    }
    public function index () {
        DB::beginTransaction();
        try {
            $data = $this->productRepository->index();
            $response = [
                'product' => $data,
            ];  
            DB::commit();
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => "Get data failed",
            ];
            return response()->json($response,403);
        }
    }
    public function getById ($id) {
        DB::beginTransaction();
        try {
            $data = $this->productRepository->getById($id);
            $response = [
                'product' => $data,
            ];  
            DB::commit();
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => "Get data failed",
            ];
            return response()->json($response,403);
        }
    }
    public function create (array $data) 
    {
        DB::beginTransaction();
        try {
            $data['slug'] = Str::slug($data['name']);
            $imageName = $this->uploadImage($data['thumbnail'] , 'product'); 
            $data['thumbnail'] = $imageName;
            $datas = $this->productRepository->create($data);
            if(isset($data['size'])) {
                foreach ($data['size'] as $sizes) {
                    $size = [
                        'size' => $sizes,
                        'product_id' => $datas->id
                    ];
                    $this->sizeRepository->create($size);
                }
            }
            if (isset($data['color']) && isset($data['color_image'])) {
                for($i = 0 ; $i < count($data['color']) ; $i++) {
                    $imageNameColor = $this->uploadImage($data['color_image'][$i] , 'color'); 
                    $imageColor = $imageNameColor;
                    $color = [
                        'color' => $data['color'][$i],
                        'image' => $imageColor,
                        'product_id' => $datas->id
                    ];
                    $this->colorRepository->create($color);
                }
            }
            DB::commit();
            $datas->size;
            $datas->color;
            $response = [
                'product' => $datas,
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => "Create failed",
            ];
            return response()->json($response,403);
        }
    }
    public function update (array $data ,$id) 
    {
        $getProduct = $this->productRepository->getById($id);
        $dataColor =  $this->colorRepository->getIdWithProduct($id);
        $dataSize =  $this->sizeRepository->getIdWithProduct($id);
        DB::beginTransaction();
        try { 
            $arraySize = $dataSize->all();
            $arrayColor = $dataColor->all();
            $data['slug'] = Str::slug($data['name']);
            $pathProduct = public_path('product').'\\'.$getProduct->thumbnail;
            //delete image
            $this->deleteImage($pathProduct);
            // create image
            $imageName = $this->uploadImage($data['thumbnail'] , 'product'); 
            $data['thumbnail'] = $imageName;
            
            $datas = $this->productRepository->update($data ,$id);
            // if(isset($data['size'])) {
            //     for ($i = 0 ; $i < count($arraySize) ; $i ++) {
            //         dd($arraySize[$id]->id);
            //         $size = [
            //             'size' => $data['size'][$i],
            //             'product_id' => $datas->id
            //         ];
            //         $this->sizeRepository->update($size ,$arraySize[$id]->id);
            //     }
            // }
            // if (isset($data['color']) && isset($data['color_image'])) {
            //     for($i = 0 ; $i < count($arrayColor) ; $i++) {
            //         $pathColor = public_path('color').'\\'.$arrayColor[$i]->image;
            //         //delete image
            //         $this->deleteImage($pathColor);
            //         $imageNameColor = $this->uploadImage($data['color_image'][$i] , 'color'); 
            //         $imageColor = $imageNameColor;
            //         $color = [
            //             'color' => $data['color'][$i],
            //             'image' => $imageColor,
            //             'product_id' => $datas->id
            //         ];
            //         $this->colorRepository->update($color,$arrayColor[$i]->id);
            //     }
            // }
            DB::commit();
            $response = [
                'message' => "Update success",
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => "Update failed",
            ];
            return response()->json($response,403);
        }
    }
    public function delete ($id) 
    {
        $dataColor =  $this->colorRepository->getIdWithProduct($id);
        $dataSize =  $this->sizeRepository->getIdWithProduct($id);
        
        DB::beginTransaction();
        try {
            $this->productRepository->delete($id);
            if($dataColor->all() != []) {
                foreach($dataColor->all() as $color) {
                    $this->colorRepository->delete($color->id);
                }
            }
            if($dataSize->all() != []) {
                foreach($dataSize->all() as $size) {
                    $this->sizeRepository->delete($size->id);
                }
            }
            DB::commit();
            $response = [
                'message' => 'Delete successfully',
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => "Delete failed",
            ];
            return response()->json($response,403);
        }
    }
}