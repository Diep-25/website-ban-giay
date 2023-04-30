<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\User\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServices $userService) 
    {
        $this->userService = $userService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->userService->create($request->all());
    }

    public function login(Request $request)
    {  
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if (!Hash::check($password, $user->password)) {
            $response = [
                'message' => 'password incorrect',
            ];
            return response()->json($response,403);
        } 
        $token = JWTAuth::fromUser($user);
        $user->Roles;     
        $response = [  
            'token' =>  $token,   
            'user' => $user
        ];
        return response()->json($response,200);
    }
}
