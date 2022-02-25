<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CountryController extends Controller
{
    
    
    public function index()
    {
        $countries = Country::Select('id','name')
        ->with(['states.cities'])
        ->get();


        return response()->json([
            'data' => $countries
        ], 200);

    }
}
