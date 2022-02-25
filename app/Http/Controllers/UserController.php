<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    //INICIO SESION
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

       

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;      
            return response()->json([
                'token' => $token,
                'sub' => $user->id,

            ], 200);
        } else {
            return response()->json(['error' => 'Email o password inválidos'], 401);
        }


        
    }

 
     //CIERRO SESION
     public function logout(Request $request)
     {
         $request->user()->token()->revoke();
         return response()->json(['message' => 'el usuario se ha desconectado']);
     }

     //REGISTRO DE USUARIO
    public function signUp(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }


        // REGISTRO UN USUARIO NUEVO
        $user = new User();

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
      


        $user->save();

        return response()->json([       
            'message' => 'Usuario registrado', 
        ], 200);
       
     
    }

}
