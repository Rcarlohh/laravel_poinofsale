<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProCatSubcategoria extends Model
{
    protected $table = 'procatsubcategoria';

    public function categoria()
    {
        return $this->belongsTo(ProCatCategoria::class, 'idProCatCategoria');
    }
}
