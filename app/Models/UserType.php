<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'usucattipoestado';

   // protected $table = 'usucattipoestado';

    // Especificar el nombre de la clave primaria si no es 'id'
    protected $primaryKey = 'id';

    // Desactivar los timestamps si tu tabla no tiene 'created_at' y 'updated_at'
    public $timestamps = false;

    // Atributos que son asignables en masa
    protected $fillable = [
        'strNombre',
        // Agrega otros campos que sean seguros para asignar masivamente
    ];

    // Relación con los usuarios
    public function users()
    {
        return $this->hasMany(User::class, 'idUsuCatTipoUsuario');
    }
}
