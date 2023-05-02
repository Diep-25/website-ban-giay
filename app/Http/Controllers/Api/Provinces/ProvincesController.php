<?php

namespace App\Http\Controllers\Api\Provinces;

use App\Http\Controllers\Controller;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvincesController extends Controller
{
    private $provinces;
    public function __construct(Provinces $provinces)
    {
        $this->provinces = $provinces;
    }
    public function index ()
    {
        DB::beginTransaction();
        try {
            $data = $this->provinces->get();
            DB::commit();
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
            for ($i=0; $i < count($datas); $i++) { 
                $this->provinces->create($datas[$i]);
            }
            DB::commit();
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
