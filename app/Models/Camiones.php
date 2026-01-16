<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CamionImagen;

class Camiones extends Model
{
    protected $fillable = [
        'categoria_id',
        'marca_id',
        'modelo_id',
        'medida',
        'anio',
        'precio',
        'kilometros',
        'ubicacion',
        'condicion',
        'combustible',
        'transmision',
        'motor',
        'transmision_detalle',
        'ejes',
        'suspension',
        'cabina',
        'peso_bruto',
        'distancia_ejes',
        'capacidad_tanque',
        'equipamiento',
        'imagen_principal',
        'descripcion',
        'estado',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(CamionImagen::class, 'camion_id')
            ->orderBy('posicion');
    }
}
