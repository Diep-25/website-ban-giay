<?php

namespace App\Services\User;

use App\Models\RoleUser;
use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserServices {
    private $userRepository;
    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }
    public function index () 
    {

    }
    public function create (array $data) 
    {      
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        try {
            $data = $this->userRepository->create($data);
            $roleUser = [
                'role_id' => 2,
                'user_id' => $data->id
            ];
            RoleUser::create($roleUser);
            DB::commit();
            $response = [
                'user' => $data,
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
    public function update () 
    {

    }
    public function delete () 
    {

    }
}