<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'password_confirmation' =>'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'register gagal', 'code status'=>401]);
        }

        $input = $request->all();
        $input['password']= bcrypt($input['password']);
        $user= User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return ResponseFormatter::success($success, 'berhasil buat akun',200);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=> 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->name)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message'=>'Hi '. $user->name.' Selamat datang',
                                    'access_token'=>$token, 
                                    'token_type'=> 'Bearer'
    ]);
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json(['message'=> 'anda telah berhasil logout']);
    }
}
