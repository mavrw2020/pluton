<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

     static $rules=[
        'lugar'=>'required',
        'fecha'=>'required',
        'objetivo'=>'required',
        'asuntosTratados'=>'required',
        'fechaProximaReunion'=>'required',
        
    ];

    protected $fillable=[
            'lugar',
            'fecha',
            'objetivo',
            'asuntosTratados',
            ];
}
