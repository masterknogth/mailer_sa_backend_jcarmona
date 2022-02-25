<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        //Si el usuario es administrador podra ver todos los correos
        if($user->rol == 1){
            $emails = Email::with(['user'])
            ->get();

        }else{
            $emails = Email::where('user_id', $user->id)
            ->with(['user'])
            ->get();
        }

        return response()->json([       
            'data' => $emails, 
        ], 200);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'destino' => 'required|email',
            'asunto' => 'required',
            'contenido' => 'required'       
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }


        // REGISTRO UN USUARIO NUEVO
        $user = Email::create([
            'user_id'   => $user->id,
            'destino'   => $request->input('destino'),
            'asunto'    => $request->input('asunto'),
            'contenido' => $request->input('contenido'),
            'estado'    => $request->input('estado'),
        ]);
       

        return response()->json([       
            'message' => 'Su correo ha sido enviado', 
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
