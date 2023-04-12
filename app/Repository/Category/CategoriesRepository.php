<?php

namespace App\Repository\Category;

use App\Models\Category;

class CategoriesRepository {
    private $category;
    public function __construct(Category $category) 
    {
        $this->category = $category;
    }
    public function index () 
    {
        return $this->category->get();
    }
    public function getById ($id) 
    {
        return $this->category->where('id',$id)->get();
    }
    public function create (array $data) 
    {
        return $this->category->create($data);
    }
    public function update (array $data , $id) 
    {
        return $this->category->find($id)->update($data);
    }
    public function delete ($id) 
    {
        return $this->category->find($id)->delete();
    }
}