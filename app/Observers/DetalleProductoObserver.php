<?php

namespace App\Observers;

use App\Models\DetalleProducto;

class DetalleProductoObserver
{
    /**
     * Handle the DetalleProducto "created" event.
     *
     * @param  \App\Models\DetalleProducto  $detalleProducto
     * @return void
     */
    public function created(DetalleProducto $detalleProducto)
    {
        paramsObservers($detalleProducto, 'create');
    }

    /**
     * Handle the DetalleProducto "updated" event.
     *
     * @param  \App\Models\DetalleProducto  $detalleProducto
     * @return void
     */
    public function updated(DetalleProducto $detalleProducto)
    {
        paramsObservers($detalleProducto, 'update');
    }

    /**
     * Handle the DetalleProducto "deleted" event.
     *
     * @param  \App\Models\DetalleProducto  $detalleProducto
     * @return void
     */
    public function deleted(DetalleProducto $detalleProducto)
    {
        paramsObservers($detalleProducto, 'delete');
    }

    /**
     * Handle the DetalleProducto "restored" event.
     *
     * @param  \App\Models\DetalleProducto  $detalleProducto
     * @return void
     */
    public function restored(DetalleProducto $detalleProducto)
    {
        //
    }

    /**
     * Handle the DetalleProducto "force deleted" event.
     *
     * @param  \App\Models\DetalleProducto  $detalleProducto
     * @return void
     */
    public function forceDeleted(DetalleProducto $detalleProducto)
    {
        //
    }
}
