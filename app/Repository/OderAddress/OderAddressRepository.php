<?php

namespace App\Repository\OderAddress;

use App\Models\OderAddress;

class OderAddressRepository {
    private $oderAddress;
    public function __construct(OderAddress $oderAddress) 
    {
        $this->oderAddress = $oderAddress;
    }
    public function create (array $data) 
    {
        return $this->oderAddress->create($data);
    }
    public function delete ($id) 
    {
        return $this->oderAddress->find($id)->delete();
    }
}