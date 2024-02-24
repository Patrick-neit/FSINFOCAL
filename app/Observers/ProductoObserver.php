<?php

namespace App\Observers;

use App\Models\Producto;

class ProductoObserver
{
    /**
     * Handle the Producto "created" event.
     *
     * @return void
     */
    public function created(Producto $producto)
    {
        //
    }

    /**
     * Handle the Producto "updated" event.
     *
     * @return void
     */
    public function updated(Producto $producto)
    {
        //
    }

    /**
     * Handle the Producto "deleted" event.
     *
     * @return void
     */
    public function deleted(Producto $producto)
    {
        //
    }

    /**
     * Handle the Producto "restored" event.
     *
     * @return void
     */
    public function restored(Producto $producto)
    {
        //
    }

    /**
     * Handle the Producto "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Producto $producto)
    {
        //
    }
}
