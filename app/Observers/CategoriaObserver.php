<?php

namespace App\Observers;

use App\Models\Categoria;

class CategoriaObserver
{
    /**
     * Handle the Categoria "created" event.
     *
     * @return void
     */
    public function created(Categoria $categoria)
    {
        paramsObservers($categoria, 'create');
    }

    /**
     * Handle the Categoria "updated" event.
     *
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        paramsObservers($categoria, 'update');
    }

    /**
     * Handle the Categoria "deleted" event.
     *
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        paramsObservers($categoria, 'delete');
    }

    /**
     * Handle the Categoria "restored" event.
     *
     * @return void
     */
    public function restored(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the Categoria "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Categoria $categoria)
    {
        //
    }
}
