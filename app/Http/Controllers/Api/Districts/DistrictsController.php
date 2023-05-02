<?php

namespace App\Http\Controllers\Api\Districts;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictsController extends Controller
{
    private $districts;
    public function __construct(Districts $districts)
    {
        $this->districts = $districts;
    }
    public function getByProvinces (Request $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $data = $this->districts->where('province_code',$request->province_code)->get();
            return response()->json($data,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => $e,
            ];
            return response()->json($response,403);
        }
    }
    public function create (Request $request) 
    {
        $datas = $request->all();
        DB::beginTransaction();
        try {
            DB::commit();
            for ($i=0; $i < count($datas); $i++) { 
                $this->districts->create($datas[$i]);
            }
            $response = [
                'message' => "create successfully",
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'error' => $e,
            ];
            return response()->json($response,403);
        }
    }
}
