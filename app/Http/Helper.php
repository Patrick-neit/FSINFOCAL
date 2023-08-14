<?php

use App\Models\PuntoVenta;

function responseJson($description, $content, $status)
{
    return response([
        'status' => $status,
        'description' => $description,
        'content' => $content,
    ], $status);
}

function verificarSiPuntoVenta($userID,$empresaID)
{
    $puntoVentaUsuario = PuntoVenta::where('user_id', $userID)->where('empresa_id', $empresaID)->first();
    return isset($puntoVentaUsuario) ? true : false;
}

function verificarPuntoVentaSucursal0($userID,$empresaID)
{
    $puntoVenta0 = PuntoVenta::where('user_id', $userID)->where('empresa_id', $empresaID)
    ->where('codigo_punto_venta',0)
    ->first();

    return isset($puntoVenta0) ? true : false;

}
