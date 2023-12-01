<?php

namespace App\Observers;

use App\Models\Sucursal;

class SucursalesObserver
{
    /**
     * Handle the Sucursal "created" event.
     *
     * @return void
     */
    public function created(Sucursal $sucursal)
    {
        paramsObservers($sucursal, 'create');
    }

    /**
     * Handle the Sucursal "updated" event.
     *
     * @return void
     */
    public function updated(Sucursal $sucursal)
    {
        paramsObservers($sucursal, 'update');
    }

    /**
     * Handle the Sucursal "deleted" event.
     *
     * @return void
     */
    public function deleted(Sucursal $sucursal)
    {
        paramsObservers($sucursal, 'delete');
    }

    /**
     * Handle the Sucursal "restored" event.
     *
     * @return void
     */
    public function restored(Sucursal $sucursal)
    {
        //
    }

    /**
     * Handle the Sucursal "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Sucursal $sucursal)
    {
        //
    }
}
