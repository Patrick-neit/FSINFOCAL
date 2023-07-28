<?php

namespace App\Http\Controllers;

use App\Services\ImpuestoCuisService;
use Illuminate\Http\Request;

class ImpuestoCuisController extends Controller
{
    public function store(Request $request)
    {
        $res = (new ImpuestoCuisService())->obtenerCuisImpuestos();
        
    }
}
