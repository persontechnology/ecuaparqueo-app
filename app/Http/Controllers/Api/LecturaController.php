<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Lectura\RqSalida;
use Illuminate\Http\Request;

class LecturaController extends Controller
{
    public function salida(RqSalida $request)
    {
        return $request;
    }
}
