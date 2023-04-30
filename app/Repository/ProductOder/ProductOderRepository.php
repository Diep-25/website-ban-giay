<?php

namespace App\Repository\ProductOder;

use App\Models\ProductOder;

class ProductOderRepository {
    private $productOder;
    public function __construct(ProductOder $productOder) 
    {
        $this->productOder = $productOder;
    }
    public function create (array $data) 
    {
        return $this->productOder->create($data);
    }
    public function delete ($id) 
    {
        return $this->productOder->find($id)->delete();
    }
}