<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index($state_id)
    {
        $cities = City::Select('id','name','state_id')
        ->where(['state_id' => $state_id])
        ->get();
        
        return response()->json([
            'data' => $cities
        ], 200);

    }
}
