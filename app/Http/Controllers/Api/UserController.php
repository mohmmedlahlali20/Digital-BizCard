<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //REgister API 
     public function register(Request $request){

        //data validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);
//save data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "status" => true,
            "message" => 'register Successfuly'
        ]);

     }

     //login API

     public function login(Request $request){

        $request->validate([
                    'email' => 'required',
                    'password' => 'required',
                ]);

                $user = User::where('email' ,  $request->email )->first();
                if(!empty($user)){
                    if(Hash::check($request->password , $user->password)){
                              $token = $user->createToken("MyToken")->plainTextToken;

                       return response()->json([
                                "status" => true ,
                                "message" => "login successfuly",
                                'token' =>   $token
                        ]);
                    }
                }

                return response()->json([
                    "status" => false ,
                    "message" => "invalid data user dosn't exist"
        ]);
     }

     //Profil API 

     public  function profile(){
        $data = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Your profile hhhh",
            "user"=> $data,
        ]);

     }

     //logout API 
     public function logout(){ 
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "user logged  successufly"
        ]);

     }



}
