<?php

namespace App\Observers;

use App\Models\Familia;

class FamiliaObserver
{
    /**
     * Handle the Familia "created" event.
     *
     * @param  \App\Models\Familia  $familia
     * @return void
     */
    public function created(Familia $familia)
    {
        paramsObservers($familia, 'create');
    }

    /**
     * Handle the Familia "updated" event.
     *
     * @param  \App\Models\Familia  $familia
     * @return void
     */
    public function updated(Familia $familia)
    {
        paramsObservers($familia, 'update');
    }

    /**
     * Handle the Familia "deleted" event.
     *
     * @param  \App\Models\Familia  $familia
     * @return void
     */
    public function deleted(Familia $familia)
    {
        paramsObservers($familia, 'delete');
    }

    /**
     * Handle the Familia "restored" event.
     *
     * @param  \App\Models\Familia  $familia
     * @return void
     */
    public function restored(Familia $familia)
    {
        //
    }

    /**
     * Handle the Familia "force deleted" event.
     *
     * @param  \App\Models\Familia  $familia
     * @return void
     */
    public function forceDeleted(Familia $familia)
    {
        //
    }
}
