<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenVentaProducto extends Model
{
    protected $table = 'venventaproducto';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no tienes timestamps, puedes desactivarlos
    
    public function venta()
    {
        return $this->belongsTo('App\VenVenta', 'idVenVenta');
    }
}
