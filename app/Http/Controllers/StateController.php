<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{

    public function index($country_id)
    {
        $states = State::Select('id','name','country_id')
        ->where(['country_id' => $country_id])
        ->get();
        
        return response()->json([
            'data' => $states
        ], 200);

    }
    
}
