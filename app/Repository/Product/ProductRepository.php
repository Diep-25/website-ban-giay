<?php

namespace App\Repository\Product;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;

class ProductRepository {
    private $product;
    private $size;
    private $color;
    public function __construct(Product $product,Size $size, Color $color) 
    {
        $this->product = $product;
        $this->size = $size;
        $this->color = $color;

    }
    public function index () 
    {
        return $this->product->with('size','color')->get();
    }
    public function getById ($id) 
    {
        return $this->product->with('size','color')->where('id',$id)->first();
    }
    public function create (array $data) 
    {
        return $this->product->create($data);
    }
    public function update (array $data , $id)  
    {
        return $this->product->find($id)->update($data);
    }
    public function delete ($id) 
    {
        return $this->product->find($id)->delete();
    }
    public function createSize(array $data) 
    {
        return $this->size->create($data);
    }
    public function createColor(array $data) 
    {
        return $this->color->create($data);
    }
}