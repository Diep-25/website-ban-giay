<?php

namespace App\Repository\User;

use App\Models\User;

class UserRepository {
    private $user;
    public function __construct(User $user) 
    {
        $this->user = $user;
    }
    public function index () 
    {

    }
    public function create (array $data) 
    {
        return $this->user->create($data);
    }
    public function update () 
    {

    }
    public function delete () 
    {

    }
}