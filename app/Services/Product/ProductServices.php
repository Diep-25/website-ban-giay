<?php

namespace App\Services\Product;

use App\Repository\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\StorageImageTrait;

class ProductServices {
    use StorageImageTrait;
    private $productRepository;
    public function __construct(ProductRepository $productRepository) 
    {
        $this->productRepository = $productRepository;    
    }
    public function index () {
        DB::beginTransaction();
        try {
            $data = $this->productRepository->index();
            $response = [
                'category' => $data,
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
                'category' => $data,
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
            if (!isset($data['size'])) {
                $data['size'] = null;
            }
            if (!isset($data['color'])) {
                $data['color'] = null;
            }
            $imageName = $this->uploadImage($data['thumbnail'] , 'product'); 
            $data['thumbnail'] = $imageName;
            //$datas = $this->productRepository->create($data);
            DB::commit();
            // $response = [
            //     'category' => $datas,
            // ];
            //return response()->json($response,200);
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
        $data['slug'] = Str::slug($data['name']);
        DB::beginTransaction();
        try {
            $this->productRepository->update($data,$id);
            DB::commit();
            $response = [
                'message' => "Update successfully",
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
        DB::beginTransaction();
        try {
            $data = $this->productRepository->delete($id);
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