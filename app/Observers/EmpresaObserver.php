<?php

namespace App\Observers;

use App\Models\Binnacle;
use App\Models\Empresa;

class EmpresaObserver
{
    /**
     * Handle the Empresa "created" event.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return void
     */
    public function created(Empresa $empresa)
    {
        Binnacle::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'action' => 'create',
            'binnacleable_id' => $empresa->id,
            'binnacleable_type' => 'App\Models\Empresa',
            'created_model_at' => now(),
            'updated_model_at' => now(),
            'deleted_model_at' => null,
        ]);
    }

    /**
     * Handle the Empresa "updated" event.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return void
     */
    public function updated(Empresa $empresa)
    {
        Binnacle::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'action' => 'update',
            'binnacleable_id' => $empresa->id,
            'binnacleable_type' => 'App\Models\Empresa',
            'updated_model_at' => now(),
        ]);
    }

    /**
     * Handle the Empresa "deleted" event.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return void
     */
    public function deleted(Empresa $empresa)
    {
        Binnacle::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'action' => 'delete',
            'binnacleable_id' => $empresa->id,
            'binnacleable_type' => 'App\Models\Empresa',
            'deleted_model_at' => now(),
        ]);
    }

    /**
     * Handle the Empresa "restored" event.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return void
     */
    public function restored(Empresa $empresa)
    {
        //
    }

    /**
     * Handle the Empresa "force deleted" event.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return void
     */
    public function forceDeleted(Empresa $empresa)
    {
        //
    }
}
