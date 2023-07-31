<?
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\ImpuestoConfigService;

class ImpuestoCuisService{

    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function obtenerCuisImpuestos($codigoPuntoVenta)
    {

        $response = Http::withToken($this->config->configService->token_sistema)
        ->post('https://www.codigos.rda-consultores.com/api/codes/cuis',[
            'codigoAmbiente' => $this->config->configService->ambiente,
            'codigoSistema' => $this->config->configService->codigo_sistema,
        ]);

        return $response->object();
    }
}
