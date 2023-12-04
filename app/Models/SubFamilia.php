<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubFamilia extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'sub_familias';

    public $fillable = [
        'familia_id',
        'nombre_sub_familia',
        'estado',
    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
