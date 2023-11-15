<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Binnacle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bitacora';
    protected $guarded = [];

    /**
     * Get the parent commentable model (post or video).
     */
    public function binnacleable(): MorphTo
    {
        return $this->morphTo();
    }
}
