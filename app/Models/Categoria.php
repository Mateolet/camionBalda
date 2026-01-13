<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Camiones;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'visible',
        'orden',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'orden'   => 'integer',
    ];

    /**
     * Relación: una categoría tiene muchos camiones
     */
    public function camiones()
    {
        return $this->hasMany(Camiones::class);
    }
}
