<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'representante_legal',
    ];

    public function configuracion_impuesto()
    {
        return $this->hasOne(ConfiguracionImpuesto::class);
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function impuestos_cuis()
    {
        return $this->hasMany(ImpuestoCuis::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class);
    }

    public function impuestos_cufds()
    {
        return $this->hasMany(ImpuestoCufd::class);
    }

    public function puntos_ventas()
    {
        return $this->hasMany(PuntoVenta::class);
    }

    public function binacle(): MorphMany
    {
        return $this->morphMany(Binnacle::class, 'binnacleable');
    }

    public function dosificaciones_sucursales()
    {
        return $this->hasMany(DosificacionEmpresa::class);
    }
}
