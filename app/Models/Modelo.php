<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelos';

    protected $fillable = [
        'marca_id',
        'nombre',
        'slug',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
