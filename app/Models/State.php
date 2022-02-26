<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
    protected $visible = [
        'id',
        'name',
        'country_id',
        'country',
        'cities'
    ];

    public function country(){
        return $this->belongsTo("App\Models\Country");
    }
    public function cities(){
        return $this->hasMany("App\Models\City");
    }
}
