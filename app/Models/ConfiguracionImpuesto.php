<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguracionImpuesto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'configuraciones_impuestos';

    protected $fillable =
    [
        'nombre_sistema',
        'ambiente',
        'modalidad',
        'codigo_sistema',
        'token_sistema',
        'empresa_id',
        'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function binacle(): MorphMany
    {
        return $this->morphMany(Binnacle::class, 'binnacleable');
    }
}
