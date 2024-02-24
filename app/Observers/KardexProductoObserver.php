<?php

namespace App\Observers;

use App\Models\KardexProducto;

class KardexProductoObserver
{
    /**
     * Handle the KardexProducto "created" event.
     *
     * @return void
     */
    public function created(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'create');
    }

    /**
     * Handle the KardexProducto "updated" event.
     *
     * @return void
     */
    public function updated(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'update');
    }

    /**
     * Handle the KardexProducto "deleted" event.
     *
     * @return void
     */
    public function deleted(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'delete');
    }

    /**
     * Handle the KardexProducto "restored" event.
     *
     * @return void
     */
    public function restored(KardexProducto $kardexProducto)
    {
        //
    }

    /**
     * Handle the KardexProducto "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(KardexProducto $kardexProducto)
    {
        //
    }
}
