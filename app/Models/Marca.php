<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Camiones;

class Marca extends Model
{
       protected $fillable = [
        'nombre',
        'slug'
    ];

       public function camiones()
    {
        return $this->hasMany(Camiones::class);
    }
}
