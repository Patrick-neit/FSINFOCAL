<?php

namespace App\Observers;

use App\Models\PuntoVenta;

class PuntoVentaObserver
{
    /**
     * Handle the PuntoVenta "created" event.
     *
     * @return void
     */
    public function created(PuntoVenta $puntoVenta)
    {
        paramsObservers($puntoVenta, 'create');
    }

    /**
     * Handle the PuntoVenta "updated" event.
     *
     * @return void
     */
    public function updated(PuntoVenta $puntoVenta)
    {
        paramsObservers($puntoVenta, 'update');
    }

    /**
     * Handle the PuntoVenta "deleted" event.
     *
     * @return void
     */
    public function deleted(PuntoVenta $puntoVenta)
    {
        paramsObservers($puntoVenta, 'delete');
    }

    /**
     * Handle the PuntoVenta "restored" event.
     *
     * @return void
     */
    public function restored(PuntoVenta $puntoVenta)
    {
        //
    }

    /**
     * Handle the PuntoVenta "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(PuntoVenta $puntoVenta)
    {
        //
    }
}
