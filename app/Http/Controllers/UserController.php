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
                'sub'   => $user->id,
                'rol'   => $user->rol,
                'loged' => true

            ], 200);
        } else {
            return response()->json(['error' => 'Email o password inválidos'], 400);
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
            'nombre' => 'required|string|max:100',
            'telefono' => 'max:10',
            'cedula' => 'required|max:11|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'fecha_nacimiento' => 'required',
            'codigo_ciudad' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }


        // REGISTRO UN USUARIO NUEVO
        $user = User::create([
            'rol'              => $request->input('rol'),
            'nombre'           => $request->input('nombre'),
            'telefono'         => $request->input('telefono'),
            'cedula'           => $request->input('cedula'),
            'email'            => $request->input('email'),
            'password'         => bcrypt($request->input('password')),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'codigo_ciudad'    => $request->input('codigo_ciudad'),
            'city_id'          => $request->input('city_id')
        ]);
       

        return response()->json([       
            'message' => 'Usuario registrado', 
        ], 200);
       
     
    }

    public function allUsers()
    {
        $users = User::select('id','nombre','telefono', 'fecha_nacimiento', 'cedula', 'email', 'codigo_ciudad','city_id')
        ->with(['city.state.country'])
        ->get();

        if($users){
            return response()->json([       
                'data' => $users, 
            ], 200);
        }else{
            return response()->json([       
                'error' => 'No hay registro', 
            ], 400);
        }
        
    }

    public function update(Request $request)
    {
        
        $rules = [
            'nombre' => 'required|string|max:100',
            'telefono' => 'max:10',
            'fecha_nacimiento' => 'required',
            'codigo_ciudad' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }


    
        $user = User::select('id')
        ->where('id', $request->input('id'))
        ->first();
        $user->update([
            'nombre'           => $request->input('nombre'),
            'telefono'         => $request->input('telefono'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'codigo_ciudad'    => $request->input('codigo_ciudad'),
            'city_id'          => $request->input('city_id')
        ]);
       

        return response()->json([       
            'message' => 'Usuario Editado', 
        ], 200);
       
     
    }

    public function delete(Request $request, $id)
    {
        $user = User::select('id')
        ->where('id', $id)
        ->first();
        $user->delete();
       
        return response()->json([       
            'message' => 'Usuario Eliminado', 
        ], 200);
       
     
    }

}
