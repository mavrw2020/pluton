<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;

     static $rules = [
        'nombre'=>'required|string',
        'puesto'=>'string',
       

    ];

    protected $fillable = [

        'nombre',
        'puesto',
       
        ];
}
