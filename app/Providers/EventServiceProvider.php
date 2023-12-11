<?php

namespace App\Providers;

use App\Models\CabeceraProducto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\ConfiguracionImpuesto;
use App\Models\DetalleProducto;
use App\Models\Empresa;
use App\Models\Familia;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\PuntoVenta;
use App\Models\SubFamilia;
use App\Models\Sucursal;
use App\Models\User;
use App\Observers\CabeceraProductoObserver;
use App\Observers\CategoriaObserver;
use App\Observers\ClienteObserver;
use App\Observers\ConfigImpuestoObserver;
use App\Observers\DetalleProductoObserver;
use App\Observers\EmpresaObserver;
use App\Observers\FamiliaObserver;
use App\Observers\MarcaObserver;
use App\Observers\ProveedorObserver;
use App\Observers\PuntoVentaObserver;
use App\Observers\SubFamiliaObserver;
use App\Observers\SucursalesObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Empresa::class => [EmpresaObserver::class],
        ConfiguracionImpuesto::class => [ConfigImpuestoObserver::class],
        PuntoVenta::class => [PuntoVentaObserver::class],
        User::class => [UserObserver::class],
        Sucursal::class => [SucursalesObserver::class],
        Marca::class => [MarcaObserver::class],
        Familia::class => [FamiliaObserver::class],
        SubFamilia::class => [SubFamiliaObserver::class],
        Categoria::class => [CategoriaObserver::class],
        Proveedor::class => [ProveedorObserver::class],
        Cliente::class => [ClienteObserver::class],
        CabeceraProducto::class => [CabeceraProductoObserver::class],
        DetalleProducto::class => [DetalleProductoObserver::class],
    ];

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
