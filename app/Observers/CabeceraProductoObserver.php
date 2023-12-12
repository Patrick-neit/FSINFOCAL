<?php

namespace App\Observers;

use App\Models\CabeceraProducto;

class CabeceraProductoObserver
{
    /**
     * Handle the CabeceraProducto "created" event.
     *
     * @param  \App\Models\CabeceraProducto  $CabeceraProducto
     * @return void
     */
    public function created(CabeceraProducto $CabeceraProducto)
    {
        paramsObservers($CabeceraProducto, 'create');
    }

    /**
     * Handle the CabeceraProducto "updated" event.
     *
     * @param  \App\Models\CabeceraProducto  $CabeceraProducto
     * @return void
     */
    public function updated(CabeceraProducto $CabeceraProducto)
    {
        paramsObservers($CabeceraProducto, 'update');
    }

    /**
     * Handle the CabeceraProducto "deleted" event.
     *
     * @param  \App\Models\CabeceraProducto  $CabeceraProducto
     * @return void
     */
    public function deleted(CabeceraProducto $CabeceraProducto)
    {
        paramsObservers($CabeceraProducto, 'update');
    }

    /**
     * Handle the CabeceraProducto "restored" event.
     *
     * @param  \App\Models\CabeceraProducto  $CabeceraProducto
     * @return void
     */
    public function restored(CabeceraProducto $CabeceraProducto)
    {
        //
    }

    /**
     * Handle the CabeceraProducto "force deleted" event.
     *
     * @param  \App\Models\CabeceraProducto  $CabeceraProducto
     * @return void
     */
    public function forceDeleted(CabeceraProducto $CabeceraProducto)
    {
        //
    }
}
