<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    // Especificar el nombre de la tabla si no sigue las convenciones de Laravel
    protected $table = 'usucatestado';

    // Especificar el nombre de la clave primaria si no es 'id'
    protected $primaryKey = 'id';

    // Desactivar los timestamps si tu tabla no tiene 'created_at' y 'updated_at'
    public $timestamps = false;

    // Atributos que son asignables en masa
    protected $fillable = [
        'strNombre', 'strDescripcion'
    ];

    // Relación con User
    public function users()
    {
        return $this->hasMany(User::class, 'idUsuCatEstado');
    }
    
}
