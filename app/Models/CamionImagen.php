<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CamionImagen extends Model
{
    protected $table = 'camion_imagenes';

    public $timestamps = false;

    protected $fillable = [
        'camion_id',
        'url',
        'posicion',
    ];

    public function camion()
    {
        return $this->belongsTo(Camiones::class, 'camion_id');
    }
}
