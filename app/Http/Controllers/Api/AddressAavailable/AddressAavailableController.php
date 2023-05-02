<?php

namespace App\Http\Controllers\Api\AddressAavailable;

use App\Http\Controllers\Controller;
use App\Models\AddressAavailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressAavailableController extends Controller
{
    private $addressAvailable;
    public function __construct(AddressAavailable $addressAvailable)
    {
        $this->addressAvailable = $addressAvailable;
    }
    public function index ()
    {
        DB::beginTransaction();
        try {
            $data = $this->addressAvailable->with('province','district','ward')->where('user_id',Auth::user()->id)->get();
            DB::commit();
            $response = [
                'list_address' => $data
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
    public function create (Request $request) 
    {
        $datas = $request->all();
        DB::beginTransaction();
        try {
            $datas['user_id'] = Auth::user()->id;
            $data = $this->addressAvailable->create($datas);
            DB::commit();
            $response = [
                'addressAvailable' => $data,
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
