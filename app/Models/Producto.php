<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'proproducto';
    
    public $timestamps = false;

    protected $fillable = [
        'strNombreProducto',
        'strDescripcion',
        'idProCatCategoria',
        'idProCatSubCategoria',
        'decMaximo',
        'decMinimo',
        'curCosto',
        'curPrecio',
        'blodImage',
        'strImage',
    ];

    public function categoria()
    {
        return $this->belongsTo(ProCatCategoria::class, 'idProCatCategoria');
    }

    public function subcategoria()
    {
        return $this->belongsTo(ProCatSubcategoria::class, 'idProCatSubCategoria');
    }
}
