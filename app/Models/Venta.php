<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Venta extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue las convenciones de Laravel
    protected $table = 'venventa';

    // Deshabilita los timestamps si no están en la tabla
    public $timestamps = false;

    // Especifica los campos que se pueden llenar de manera masiva
    protected $fillable = [
        'idUsuario',
        'strFolio',
        'dteFechaVenta',
        'idVenCatEstado',
    ];

    // Relación con la tabla de productos de la venta
    public function productos()
    {
        return $this->hasMany(VenVentaProducto::class, 'idVenVenta');
    }
}
