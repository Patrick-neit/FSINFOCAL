<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'empresas';
    protected $fillable = [
        'nombre_empresa',
        'nro_nit_empresa',
        'direccion',
        'telefono',
        'correo',
        'logo',
        'representante_legal'
    ];

    public function configuracion_impuesto ()
    {
        return $this->hasOne(ConfiguracionImpuesto::class);
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
