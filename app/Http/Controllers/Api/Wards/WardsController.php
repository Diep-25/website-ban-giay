<?php

namespace App\Http\Controllers\Api\Wards;

use App\Http\Controllers\Controller;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WardsController extends Controller
{
    private $wards;
    public function __construct(Wards $wards)
    {
        $this->wards = $wards;
    }
    public function getByDistrict (Request $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $data = $this->wards->where('district_code',$request->district_code)->get();
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
                $this->wards->create($datas[$i]);
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
