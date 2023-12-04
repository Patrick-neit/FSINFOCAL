<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Familia extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'familias';

    public $fillable = [
        'nombre_familia',
        'estado',
    ];

    public function sub_familias()
    {
        return $this->hasMany(SubFamilia::class);
    }
}
