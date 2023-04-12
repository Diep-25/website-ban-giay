<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Services\Category\CategoriesServices;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categoriesServices;
    public function __construct(CategoriesServices $categoriesServices) 
    {
        $this->categoriesServices = $categoriesServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->categoriesServices->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        return $this->categoriesServices->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $request)
    {
        return $this->categoriesServices->getById($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $request->id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request)
    {
        return $this->categoriesServices->update($request->all() , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        return $this->categoriesServices->delete($request->id);
    }
}
