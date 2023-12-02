<?php

use App\Models\Binnacle;
use App\Models\PuntoVenta;

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
    $puntoVentaUsuario = PuntoVenta::where('empresa_id', $empresaID)->first();

    return isset($puntoVentaUsuario) ? true : false;
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
