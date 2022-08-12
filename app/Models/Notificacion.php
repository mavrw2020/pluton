<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

     static $rules=[
        'destinatario'=>'string|required',
        'prioridad'=>'integer',
        'titulo'=>'string',
        'leido'=>'integer',        
    ];

    protected $fillable=[
            'destinatario',
            'prioridad',
            'titulo',
            'leido',
        
            ];
}
