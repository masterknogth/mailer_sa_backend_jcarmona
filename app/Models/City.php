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
    ];
    public function State(){
        return $this->belongsTo("App\Models\State");
    }
}
