<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        //validation
        // dd($request);
        $fields = $request->validate(
            [
                'name' =>'required|string',
                'email' =>'required|string|unique:users,email',
                'password' =>'required|string|confirmed',
            ]);

        //create user    
        $user = User::create([
            'name' =>$fields['name'],
            'email' =>$fields['email'],
            'password' =>bcrypt($fields['password'])
        ]);

        //token
        $token=$user->createToken('myapptoken')->plainTextToken;
        
        $response = [
            'user' =>$user,
            'token' =>$token
        ];
        return response($response, 201);
    }
    public function login(Request $request){
        //validate
        $fields = $request->validate(
            [
                'email' =>'required|string',
                'password' =>'required|string',
            ]);
        
        //check email
        $user = User::where('email',$fields['email'])->first();

        //check password
        if(!$user ||!Hash::check($fields['password'],$user->password)){            
            return response([
                'message' => 'bad creds'
            ],401); 
        };

        //token
        $token=$user->createToken('myapptoken')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
}
