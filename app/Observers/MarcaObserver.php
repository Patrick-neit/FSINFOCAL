<?php

namespace App\Observers;

use App\Models\Marca;

class MarcaObserver
{
    /**
     * Handle the Marca "created" event.
     *
     * @return void
     */
    public function created(Marca $marca)
    {
        paramsObservers($marca, 'create');
    }

    /**
     * Handle the Marca "updated" event.
     *
     * @return void
     */
    public function updated(Marca $marca)
    {
        paramsObservers($marca, 'update');
    }

    /**
     * Handle the Marca "deleted" event.
     *
     * @return void
     */
    public function deleted(Marca $marca)
    {
        paramsObservers($marca, 'delete');
    }

    /**
     * Handle the Marca "restored" event.
     *
     * @return void
     */
    public function restored(Marca $marca)
    {
        //
    }

    /**
     * Handle the Marca "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Marca $marca)
    {
        //
    }
}
