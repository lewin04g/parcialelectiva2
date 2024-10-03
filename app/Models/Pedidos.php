<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'nombre_medicamento',
        'id_tipo_medi',
        'cantidad',
        'id_distri',
        'id_sucur'
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'id_sucur');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidores::class, 'id_distri');
    }

    public function tipoMedicamento()
    {
        return $this->belongsTo(Tiposdemedicamentos::class, 'id_tipo_medi');
    }
}
