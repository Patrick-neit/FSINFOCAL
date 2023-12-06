<?php

namespace App\Observers;

use App\Models\Cliente;

class ClienteObserver
{
    /**
     * Handle the Cliente "created" event.
     *
     * @return void
     */
    public function created(Cliente $cliente)
    {
        paramsObservers($cliente, 'create');
    }

    /**
     * Handle the Cliente "updated" event.
     *
     * @return void
     */
    public function updated(Cliente $cliente)
    {
        paramsObservers($cliente, 'update');
    }

    /**
     * Handle the Cliente "deleted" event.
     *
     * @return void
     */
    public function deleted(Cliente $cliente)
    {
        paramsObservers($cliente, 'delete');
    }

    /**
     * Handle the Cliente "restored" event.
     *
     * @return void
     */
    public function restored(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Cliente "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Cliente $cliente)
    {
        //
    }
}
