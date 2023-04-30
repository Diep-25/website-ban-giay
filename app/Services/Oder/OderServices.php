<?php

namespace App\Services\Oder;

use App\Repository\Oder\OderRepository;
use App\Repository\OderAddress\OderAddressRepository;
use App\Repository\ProductOder\ProductOderRepository;
use Illuminate\Support\Facades\DB;
class OderServices {
    private $oderRepository;
    private $oderAddressRepository;
    private $productOderRepository;
    public function __construct(
        OderRepository $oderRepository , 
        OderAddressRepository $oderAddressRepository,
        ProductOderRepository $productOderRepository) 
    {
       $this->oderRepository = $oderRepository;
       $this->oderAddressRepository = $oderAddressRepository;
       $this->productOderRepository = $productOderRepository; 
    }
    public function index () {

    }
    public function create (array $data) 
    {     
        DB::beginTransaction();
        try {
            $oderAddress = $this->oderAddressRepository->create($data['address']);
            $data['oders']['oder_address_id'] = $oderAddress->id;
            $oder = $this->oderRepository->create($data['oders']);
           for($i = 0 ; $i < count($data['products']) ; $i ++) {
            $productOder = [
                'oder_id' => $oder->id,
                'product_id' => $data['products'][$i]['id']
            ];
            $this->productOderRepository->create($productOder);
           }
            DB::commit();
            $response = [
                'message' => "Oder success",
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
    public function approve (array $data ,$id) 
    {   
        DB::beginTransaction();
        try {
            $this->oderRepository->approve($data , $id);
            DB::commit();
            $response = [
                'message' => "Thay đổi status thành công",
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
    public function delete () 
    {

    }
}