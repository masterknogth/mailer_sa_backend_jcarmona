<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',           
        'nombre',         
        'destino',     
        'asunto',        
        'contenido',        
        'estado'    
    ];

    protected $visible = [
        'id',
        'user_id',           
        'nombre',         
        'destino',     
        'asunto',        
        'contenido',        
        'estado',
        'user'    
    ];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}
