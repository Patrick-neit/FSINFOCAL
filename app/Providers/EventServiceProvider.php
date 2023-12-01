<?php

namespace App\Providers;

use App\Models\ConfiguracionImpuesto;
use App\Models\Empresa;
use App\Models\PuntoVenta;
use App\Models\Sucursal;
use App\Models\User;
use App\Observers\ConfigImpuestoObserver;
use App\Observers\EmpresaObserver;
use App\Observers\PuntoVentaObserver;
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
