<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenVenta extends Model
{
    protected $table = 'venventa';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no tienes timestamps, puedes desactivarlos
    
    public function estado()
    {
        return $this->belongsTo('App\Models\VenCatEstado', 'idVenCatEstado');
    }
    
    public function productos()
    {
        return $this->hasMany('App\Models\VenVentaProducto', 'idVenVenta');
    }
    
    public function obtenerEstado()
    {
        return $this->estado;
    }
    
    public function obtenerProductos()
    {
        return $this->productos;
    }
}
