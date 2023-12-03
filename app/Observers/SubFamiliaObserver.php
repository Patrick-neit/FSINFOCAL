<?php

namespace App\Observers;

use App\Models\SubFamilia;

class SubFamiliaObserver
{
    /**
     * Handle the SubFamilia "created" event.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return void
     */
    public function created(SubFamilia $subFamilia)
    {
        paramsObservers($subFamilia, 'create');
    }

    /**
     * Handle the SubFamilia "updated" event.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return void
     */
    public function updated(SubFamilia $subFamilia)
    {
        paramsObservers($subFamilia, 'update');
    }

    /**
     * Handle the SubFamilia "deleted" event.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return void
     */
    public function deleted(SubFamilia $subFamilia)
    {
        paramsObservers($subFamilia, 'delete');
    }

    /**
     * Handle the SubFamilia "restored" event.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return void
     */
    public function restored(SubFamilia $subFamilia)
    {
        //
    }

    /**
     * Handle the SubFamilia "force deleted" event.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return void
     */
    public function forceDeleted(SubFamilia $subFamilia)
    {
        //
    }
}
