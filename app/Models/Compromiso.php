<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compromiso extends Model
{
    use HasFactory;

     static $rules = [

        
        'tarea'         =>  'string',
        'responsable'   =>  'string',
        'fechaEntrega'  =>  'date',
    ];

    protected $fillable = [
        'tarea',
        'responsable',
        'fechaEntrega',
    ];
}
