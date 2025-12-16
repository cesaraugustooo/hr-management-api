<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $creds = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
            'name' => 'required|string'
        ]);

        $creds = array_merge($creds,['password'=>Hash::make($creds['password'])]);

        $user = User::create($creds);

        return response()->json(['message'=>'usuario criado com sucesso'],200);
    }

    public function login(Request $request){
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:12'
        ]);

        $token = Auth::attempt($creds);

        if(!$token){
            return response()->json(['message'=>'Credenciais Invalidas'],401);
        }

        return response()->json(['message'=>'success','user'=>$request->user()])->cookie('jwt',$token,60,'/',null,false,true);
    }
}
