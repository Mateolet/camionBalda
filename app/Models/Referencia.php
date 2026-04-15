<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';

    protected $fillable = [
        'publicacion',
        'descripcion',
        'imagen1',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5',
    ];
}
