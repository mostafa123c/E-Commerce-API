<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    use ApiResponseTrait;

    public function register($request)
    {
        $validations =  Validator::make($request->all() , [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:4'
        ]);

        if($validations->fails())
        {
            return $this->apiResponse(400,'validation error' , $validations->errors());
        }

        User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->apiResponse(200, 'account was created');
    }

    public function login($request)
    {
        $validations =  Validator::make($request->all() , [
            'email' => 'required',
            'password' => 'required|min:4'
        ]);

        if($validations->fails())
        {
            return $this->apiResponse(400,'validation error' , $validations->errors());
        }

        $credentials = $request->only('email', 'password');
        //$credentials = request(['email', 'password']);

        if ( $token = Auth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return $this->apiResponse(400 , 'not found');

    }

    protected function respondWithToken($token)
    {
        $array = [
            'access_token' => $token,
//            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return $this->apiResponse('200' , 'login' , null , $array);
    }


}
