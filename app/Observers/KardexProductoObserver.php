<?php

namespace App\Observers;

use App\Models\KardexProducto;

class KardexProductoObserver
{
    /**
     * Handle the KardexProducto "created" event.
     *
     * @param  \App\Models\KardexProducto  $kardexProducto
     * @return void
     */
    public function created(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'create');
    }

    /**
     * Handle the KardexProducto "updated" event.
     *
     * @param  \App\Models\KardexProducto  $kardexProducto
     * @return void
     */
    public function updated(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'update');
    }

    /**
     * Handle the KardexProducto "deleted" event.
     *
     * @param  \App\Models\KardexProducto  $kardexProducto
     * @return void
     */
    public function deleted(KardexProducto $kardexProducto)
    {
        paramsObservers($kardexProducto, 'delete');
    }

    /**
     * Handle the KardexProducto "restored" event.
     *
     * @param  \App\Models\KardexProducto  $kardexProducto
     * @return void
     */
    public function restored(KardexProducto $kardexProducto)
    {
        //
    }

    /**
     * Handle the KardexProducto "force deleted" event.
     *
     * @param  \App\Models\KardexProducto  $kardexProducto
     * @return void
     */
    public function forceDeleted(KardexProducto $kardexProducto)
    {
        //
    }
}
