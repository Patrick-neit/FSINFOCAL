<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableInterface
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellidos',
        'departamento_id',
        'email',
        'password',
        'fecha_nacimiento',
        'ci',
        'fotografia',
        'google_id',
        'google_token',
        'google_refresh_token',
        'banned_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }

    public function punto_venta()
    {
        return $this->hasOne(PuntoVenta::class);
    }

    public function binacle(): MorphMany
    {
        return $this->morphMany(Binnacle::class, 'binnacleable');
    }
}
