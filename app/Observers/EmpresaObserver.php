<?php

namespace App\Observers;

use App\Models\Binnacle;
use App\Models\Empresa;
use Auth;

class EmpresaObserver
{
    /**
     * Handle the Empresa "created" event.
     *
     * @return void
     */
    public function created(Empresa $empresa)
    {
        // dd(Auth::id());
        Binnacle::create([
            'user_id' => Auth::id(),
            // 'ip' => request()->ip(),
            'ip' => '1',
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
     * @return void
     */
    public function updated(Empresa $empresa)
    {
        Binnacle::create([
            'user_id' => auth()->user()->id,
            // 'ip' => request()->ip(),
            'ip' => 'fa',
            'action' => 'update',
            'binnacleable_id' => $empresa->id,
            'binnacleable_type' => 'App\Models\Empresa',
            'updated_model_at' => now(),
        ]);
    }

    /**
     * Handle the Empresa "deleted" event.
     *
     * @return void
     */
    public function deleted(Empresa $empresa)
    {
        Binnacle::create([
            'user_id' => auth()->user()->id,
            // 'ip' => request()->ip(),
            'ip' => 'fa',
            'action' => 'delete',
            'binnacleable_id' => $empresa->id,
            'binnacleable_type' => 'App\Models\Empresa',
            'deleted_model_at' => now(),
        ]);
    }

    /**
     * Handle the Empresa "restored" event.
     *
     * @return void
     */
    public function restored(Empresa $empresa)
    {
        //
    }

    /**
     * Handle the Empresa "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Empresa $empresa)
    {
        //
    }
}
