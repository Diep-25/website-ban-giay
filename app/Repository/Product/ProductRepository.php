<?php

namespace App\Repository\Product;

use App\Models\Product;

class ProductRepository {
    private $product;
    public function __construct(Product $product) 
    {
        return $this->product = $product;
    }
    public function index () 
    {
        return $this->product->get();
    }
    public function getById ($id) 
    {
        return $this->product->where('id',$id)->get();
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
}