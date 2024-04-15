<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenCatEstado extends Model
{
    protected $table = 'vencatestado';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no tienes timestamps, puedes desactivarlos
    
    public function ventas()
    {
        return $this->hasMany('App\VenVenta', 'idVenCatEstado');
    }
}
