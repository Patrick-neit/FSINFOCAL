<?php

namespace App\Console\Commands;

use App\Http\Controllers\CatalogosController;
use Illuminate\Console\Command;

class SincronizarCatalogos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sincronizar:catalogos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza los Catalogos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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

        return Command::SUCCESS;
    }
}
