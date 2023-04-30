<?php

namespace App\Repository\Oder;

use App\Models\Oders;

class OderRepository {
    private $oders;
    public function __construct(Oders $oders) 
    {
        $this->oders = $oders;
    }
    public function index () 
    {
        return $this->oders->get();
    }
    public function create (array $data) 
    {
        return $this->oders->create($data);
    }
    public function approve (array $data , $id) 
    {
        return $this->oders->find($id)->update($data);
    }
    public function delete ($id) 
    {
        return $this->oders->find($id)->delete();
    }
}