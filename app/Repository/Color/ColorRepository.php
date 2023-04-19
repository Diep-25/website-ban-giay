<?php

namespace App\Repository\Color;

use App\Models\Color;

class ColorRepository {
    private $color;
    public function __construct(Color $color) 
    {
        $this->color = $color;
    }
    
    public function getById ($id) 
    {
        return $this->color->where('id',$id)->get();
    }
    public function getIdWithProduct($idProduct) 
    {
        return $this->color->where('product_id', $idProduct)->get();
    }
    public function create (array $data) 
    {
        return $this->color->create($data);
    }
    public function update (array $data , $id) 
    {
        return $this->color->find($id)->update($data);
    }
    public function delete ($id) 
    {
        return $this->color->find($id)->delete();
    }
}