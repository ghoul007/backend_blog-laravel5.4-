<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class ApiAuthController extends Controller
{
    public function authentificate(){

        $credentials= \request()->only('email','password');
        try{
            $token = JWTAuth::attempt($credentials);
            if(!$token){
                return response()->json(['error'=>'invalid_credentials'],401);
            }
        }catch(JWTException $e){
            return response()->json(['error'=>'something_went_wrong'],500);
        }
        //get user date

        //check if user are account
        return response()->json(['token'=>$token],200);

    }

    public function register(){
        $email = request()->email;
        $name = request()->name;
        $password = request()->password;
        $user= User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>bcrypt($password)
        ] );
        $token = JWTAuth::fromUser($user);

        return response()->json(['token'=>$token],200);
    }
}

























