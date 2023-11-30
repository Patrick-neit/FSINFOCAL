<?php

namespace App\Jobs;

use App\Http\Controllers\CatalogosController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SincCatalogos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CatalogosController $catalogosController)
    {
        $acciones = [
            config('sistema.sincMotivoAnulacion'),
            config('sistema.sincFechaHora'),
            config('sistema.sincTipoDocumentoSector'),
            config('sistema.sincActividadesDocumentoSector'),
            config('sistema.sincTiposFactura'),
            config('sistema.sincMensajesServicios'),
            config('sistema.sincEventosSignificativos'),
            config('sistema.sincTipoPV'),
            config('sistema.sincProductosServicios'),
            config('sistema.sincTipoMoneda'),
            config('sistema.sincActividades'),
            config('sistema.sincTipoEmision'),
            config('sistema.sincTipoDocumentoIdentidad'),
            config('sistema.sincLeyendas'),
            config('sistema.sincTipoMetodoPago'),
            config('sistema.sincUnidadMedida'),
            config('sistema.sincPaisOrigen'),
            config('sistema.sincTipoHabitacion'),
        ];
        foreach ($acciones as $accion) {
            (new CatalogosController())->sincronizarCatalogos($accion);
        }
    }
}
