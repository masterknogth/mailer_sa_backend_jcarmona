<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
    protected $visible = [
        'id',
        'name',
        'state_id',
        'state'
    ];
    public function state(){
        return $this->belongsTo("App\Models\State");
    }
}
