<?php

namespace App\Observers;

use App\Models\InventarioAlmacen;

class InventarioAlmacenObserver
{
    /**
     * Handle the InventarioAlmacen "created" event.
     *
     * @return void
     */
    public function created(InventarioAlmacen $inventarioAlmacen)
    {
        paramsObservers($inventarioAlmacen, 'create');
    }

    /**
     * Handle the InventarioAlmacen "updated" event.
     *
     * @return void
     */
    public function updated(InventarioAlmacen $inventarioAlmacen)
    {
        paramsObservers($inventarioAlmacen, 'update');
    }

    /**
     * Handle the InventarioAlmacen "deleted" event.
     *
     * @return void
     */
    public function deleted(InventarioAlmacen $inventarioAlmacen)
    {
        paramsObservers($inventarioAlmacen, 'delete');
    }

    /**
     * Handle the InventarioAlmacen "restored" event.
     *
     * @return void
     */
    public function restored(InventarioAlmacen $inventarioAlmacen)
    {
        //
    }

    /**
     * Handle the InventarioAlmacen "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(InventarioAlmacen $inventarioAlmacen)
    {
        //
    }
}
