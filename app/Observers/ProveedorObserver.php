<?php

namespace App\Observers;

use App\Models\Proveedor;

class ProveedorObserver
{
    /**
     * Handle the Proveedor "created" event.
     *
     * @return void
     */
    public function created(Proveedor $proveedor)
    {
        paramsObservers($proveedor, 'create');
    }

    /**
     * Handle the Proveedor "updated" event.
     *
     * @return void
     */
    public function updated(Proveedor $proveedor)
    {
        paramsObservers($proveedor, 'update');
    }

    /**
     * Handle the Proveedor "deleted" event.
     *
     * @return void
     */
    public function deleted(Proveedor $proveedor)
    {
        paramsObservers($proveedor, 'delete');
    }

    /**
     * Handle the Proveedor "restored" event.
     *
     * @return void
     */
    public function restored(Proveedor $proveedor)
    {
        //
    }

    /**
     * Handle the Proveedor "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Proveedor $proveedor)
    {
        //
    }
}
