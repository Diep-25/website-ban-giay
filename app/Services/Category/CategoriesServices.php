<?php

namespace App\Services\Category;

use App\Repository\Category\CategoriesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesServices {
    private $categoryRepository;
    public function __construct(CategoriesRepository $categoriesRepository) 
    {
        $this->categoryRepository = $categoriesRepository;
    }
    public function index () {
        DB::beginTransaction();
        try {
            $data = $this->categoryRepository->index();
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
            $data = $this->categoryRepository->getById($id);
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
        $data['slug'] = Str::slug($data['name']);
        DB::beginTransaction();
        try {
            $data = $this->categoryRepository->create($data);
            DB::commit();
            $response = [
                'category' => $data,
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
        $data['slug'] = Str::slug($data['name']);
        DB::beginTransaction();
        try {
            $this->categoryRepository->update($data,$id);
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
            $data = $this->categoryRepository->delete($id);
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