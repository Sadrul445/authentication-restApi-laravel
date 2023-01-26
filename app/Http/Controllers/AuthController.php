<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Facades\Hash;
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
    public function login(){
        
    }
    public function logout(){
        
    }
}
