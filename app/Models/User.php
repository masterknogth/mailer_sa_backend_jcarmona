<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rol',           
        'nombre',         
        'telefono',     
        'cedula',        
        'email',        
        'password',        
        'fecha_nacimiento',
        'codigo_ciudad',
        'city_id'     
    ];

    protected $appends = [
        'edad',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city(){
        return $this->belongsTo("App\Models\City");
    }

    public function getEdadAttribute(): string
    {
        $fecha_actual = now();
        $edad = $fecha_actual->DiffInYears($this->fecha_nacimiento);

        return $edad;
       
    }

}
