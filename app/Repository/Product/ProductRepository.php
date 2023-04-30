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
        return $this->product->with('size','options')->get();
    }
    public function fillter (array $data) 
    {
        if(isset($data['search'])) 
        {
            return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('name', 'like', '%' . $data['search'] . '%')->get();
        }
        if(isset($data['_sort']) && !isset($data['price_lte']) && !isset($data['price_gte'])){
            return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->orderBy($data['_sort'],$data['_order'])->get();
        } else if(isset($data['_sort']) && isset($data['price_lte']) || isset($data['price_gte'])) {

            if(isset($data['price_lte']) && !isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','<' , $data['price_lte'])->orderBy($data['_sort'],$data['_order'])->get();
            } else if (!isset($data['price_lte']) && isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','>=' , $data['price_gte'])->orderBy($data['_sort'],$data['_order'])->get();
            } else if (isset($data['price_lte']) && isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','>=' , $data['price_gte'])->where('price','<' , $data['price_lte'])->orderBy($data['_sort'],$data['_order'])->get();
            }

        } else {

            if(isset($data['price_lte']) && !isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','<' , $data['price_lte'])->get();
            } else if (!isset($data['price_lte']) && isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','>=' , $data['price_gte'])->get();
            } else if (isset($data['price_lte']) && isset($data['price_gte'])) {
                return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->where('price','>=' , $data['price_gte'])->where('price','<' , $data['price_lte'])->get();
            }
            
        }
        return $this->product->with('size','options')->forPage($data['_page'],$data['_limit'])->get();
        
        
    }
    public function getById ($id) 
    {
        return $this->product->with('size','options')->where('id',$id)->first();
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