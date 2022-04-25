<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\addUserRequest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function addUser(Request $req, addUserRequest $request){
        // $user = $req->user();
        
        // // if($user->id ==$user->tokenCan('create')){
        //     $input = $request->all();
        //     $input['password']= bcrypt($input['password']);
        //     $user= User::create($input);
        //     $success['token'] = $user->createToken("access_token", ["read"])->plainTextToken;
        //     $success['name'] = $user->name;
    
        //     return ResponseFormatter::success($success, 'berhasil buat akun',200);
        // // }else{
        // //     return ResponseFormatter::error( null, 'anda bukan super admin', 401);

        // // }

        $user = $req->user();
        
        // if($user->id ==$user->tokenCan('create')){
            $input = $request->all();
            $input['password']= bcrypt($input['password']);
            $user= User::create($input);
            $success['token'] = $user->createToken("access_token")->plainTextToken;
            $success['name'] = $user->name;
    
            return ResponseFormatter::success($success, 'berhasil buat akun',200);
        // }else{
        //     return ResponseFormatter::error( null, 'anda bukan super admin', 401);

        // }

      
    }


    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=> 'Unauthorized'], 401);
        }

        // $user = User::where('email', $request->email)->firstOrFail();
        // if($user->id===1){
        //     $token = $user->createToken("access_token", ["create"])->plainTextToken;
        //     return response()->json(['message'=>'Hi '. $user->name.' Selamat datang',
        //     'access_token'=>$token, 
        //     'token_type'=> 'Bearer']);
        // }else{
        //     $token = $user->createToken("access_token", ["read"])->plainTextToken;
        //     return response()->json(['message'=>'Hi '. $user->name.' Selamat datang',
        //                                 'access_token'=>$token, 
        //                                 'token_type'=> 'Bearer']);
        // }


        $user = User::where('email', $request->email)->firstOrFail();
        // if($user->id===1){
            $token = $user->createToken("access_token")->plainTextToken;
            return response()->json(['message'=>'Hi '. $user->name.' Selamat datang',
            'access_token'=>$token, 
            'token_type'=> 'Bearer']);
        // }else{
        //     $token = $user->createToken("access_token", ["read"])->plainTextToken;
        //     return response()->json(['message'=>'Hi '. $user->name.' Selamat datang',
        //                                 'access_token'=>$token, 
        //                                 'token_type'=> 'Bearer']);
        // }
        
        // else{
        //     $token = $user->createToken("access_token",["read"])->plainTextToken;
        // }
           
       
    
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json(['message'=> 'anda telah berhasil logout']);
    }

    public function all(Request $request){
        $paginate = $request->input('data');
        $users = User::paginate($paginate);
        return ResponseFormatter::success($users, 'data berhasil diambil', 200);

    }
}
