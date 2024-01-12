<?php

use App\Models\Binnacle;
use App\Models\ClienteTipoPrecio;
use App\Models\PuntoVenta;
use App\Models\CatalogoPrecioProducto;
use App\Models\CabeceraProducto;

function responseJson($description, $content, $status)
{
    return response([
        'status' => $status,
        'description' => $description,
        'content' => $content,
    ], $status);
}

function verificarSiPuntoVenta($empresaID)
{
    $puntoVentaUsuario = PuntoVenta::where('empresa_id', $empresaID)
        ->get();

    return count($puntoVentaUsuario) >= 1 ? true : false;
}

function verificarPuntoVentaSucursal0($empresaID)
{
    $puntoVenta0 = PuntoVenta::where('empresa_id', $empresaID)
        ->where('codigo_punto_venta', 0)
        ->first();

    return isset($puntoVenta0) ? true : false;
}

/**
 * Registrar en la tabla Bitácoras
 *
 * @return void
 */
function paramsObservers($modelo, $action)
{
    Binnacle::create([
        'user_id' => isset(auth()->user()->id) ? auth()->user()->id : 1,
        'ip' => request()->ip(),
        'action' => $action,
        'binnacleable_id' => $modelo->id,
        'binnacleable_type' => get_class($modelo),
        'created_model_at' => now(),
        'updated_model_at' => $action == 'update' ? now() : null,
        'deleted_model_at' => $action == 'delete' ? now() : null,
    ]);
}

function selectTipoPrecio($value, $cliente_id)
{
    $productos = CabeceraProducto::select('id')->get();

    foreach ($productos as $producto){
        $tipo_precio = new CatalogoPrecioProducto();
        switch ($value) {
            case 1:
                $tipo_precio->tipo_precio_a = 1;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 2:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 1;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 3:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 1;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 4:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 1;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 5:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 1;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 6:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 1;
                $tipo_precio->tipo_precio_g = 0;
                break;
            case 7:
                $tipo_precio->tipo_precio_a = 0;
                $tipo_precio->tipo_precio_b = 0;
                $tipo_precio->tipo_precio_c = 0;
                $tipo_precio->tipo_precio_d = 0;
                $tipo_precio->tipo_precio_e = 0;
                $tipo_precio->tipo_precio_f = 0;
                $tipo_precio->tipo_precio_g = 1;
                break;
        }
        $tipo_precio->cliente_id = $cliente_id;
        $tipo_precio->producto_id = $producto->id;
        $tipo_precio->save();
    }
}
