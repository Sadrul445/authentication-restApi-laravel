<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        //vaidation
        $data = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password'=> 'required|string|confirmed'
            ]
            );
        //create_user
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]
    );
        //token

        $token = $user->createToken('myapptoken')->plainTextToken; 
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return Response($response,201);

    }
    public function login(Request $request){
        $data = $request->validate(
            [
                'email' => "required|string",
                'password'=>"required|string"
            ]
        );

        //check email
        $user = User::where('email',$data['email'])->first();

        //Check Pass

        if(!$user||!Hash::check($data['password'],$user->password)){
            return response([
                'message' => 'bad creds'
            ],401);
        }
        $token=$user->createToken('myappToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token'=> $token
        ];
        return Response($response,201);

    }
    
}
