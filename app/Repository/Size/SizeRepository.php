<?php

namespace App\Repository\Size;

use App\Models\Size;

class SizeRepository {
    private $size;
    public function __construct(Size $size) 
    {
        $this->size = $size;
    }
    
    public function getById ($id) 
    {
        return $this->size->where('id',$id)->first();
    }
    public function getIdWithProduct($idProduct) 
    {
        return $this->size->where('product_id', $idProduct)->get();
    }
    public function create (array $data) 
    {
        return $this->size->create($data);
    }
    public function update (array $data , $id) 
    {
        return $this->size->find($id)->update($data);
    }
    public function delete ($id) 
    {
        return $this->size->find($id)->delete();
    }
}