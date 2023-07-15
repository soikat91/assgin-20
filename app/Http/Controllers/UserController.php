<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;

class UserController extends Controller
{   

    function userLogin(Request $request){

       $result=User::where($request->input())->count();

       if($result==1){

       $token=JWTToken::CreateToken($request->input('email'));
       return response()->json([
        'status'=>"success",
        'data'=>$token
       ]);

       }else{
        return response()->json([
            'status'=>"success",
            'data'=>"unauthorized"
           ]);

       }
        

    }
    function userRegistration(Request $request){

        try{
            User::create([
            
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'password'=>$request->input('password')
            ]);
        }catch(Exception $e){

            return response()->json([
                'status'=>'failed',
               // 'message'=>"Data Insert Failed"
                'message'=>$e->getMessage()
            ],200);
        }     
       

       
    }     
   
}
