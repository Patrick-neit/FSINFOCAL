<?
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\ImpuestoConfigService;

class ImpuestoCuisService
{

    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function obtenerCuisImpuestos($dataCuis)
    {

        $response = Http::withToken($this->config->configService->token_sistema)
        ->post('https://www.codigos.rda-consultores.com/api/codes/cuis',[
            'codigoAmbiente' => $this->config->configService->codigoAmbiente,
            'codigoSistema' => $this->config->configService->codigoSistema,
            'nit' => $this->config->configService->nit,
            'codigoModalidad'=> $this->config->configService->modalidad,
            'codigoSucursal' => $dataCuis->tipo_punto_venta ,
            'codigoPuntoVenta'=> $dataCuis->sucursal_id
        ]);

        return $response->object();
    }
}
