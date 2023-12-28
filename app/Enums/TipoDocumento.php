<?php

namespace App\Enums;

enum TipoDocumento: int
{
    case Factura = 1;
    case Nota_de_Venta = 2;
    case Otros = 3;
}
