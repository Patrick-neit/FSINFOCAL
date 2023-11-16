<?php

namespace App\Observers;

use App\Models\ConfiguracionImpuesto;

class ConfigImpuestoObserver
{
    /**
     * Handle the ConfiguracionImpuesto "created" event.
     *
     * @param  \App\Models\ConfiguracionImpuesto  $configuracionImpuesto
     * @return void
     */
    public function created(ConfiguracionImpuesto $configuracionImpuesto)
    {
        paramsObservers($configuracionImpuesto, 'create');
    }

    /**
     * Handle the ConfiguracionImpuesto "updated" event.
     *
     * @param  \App\Models\ConfiguracionImpuesto  $configuracionImpuesto
     * @return void
     */
    public function updated(ConfiguracionImpuesto $configuracionImpuesto)
    {
        paramsObservers($configuracionImpuesto, 'update');
    }

    /**
     * Handle the ConfiguracionImpuesto "deleted" event.
     *
     * @param  \App\Models\ConfiguracionImpuesto  $configuracionImpuesto
     * @return void
     */
    public function deleted(ConfiguracionImpuesto $configuracionImpuesto)
    {
        paramsObservers($configuracionImpuesto, 'delete');
    }

    /**
     * Handle the ConfiguracionImpuesto "restored" event.
     *
     * @param  \App\Models\ConfiguracionImpuesto  $configuracionImpuesto
     * @return void
     */
    public function restored(ConfiguracionImpuesto $configuracionImpuesto)
    {
        //
    }

    /**
     * Handle the ConfiguracionImpuesto "force deleted" event.
     *
     * @param  \App\Models\ConfiguracionImpuesto  $configuracionImpuesto
     * @return void
     */
    public function forceDeleted(ConfiguracionImpuesto $configuracionImpuesto)
    {
        //
    }
}
