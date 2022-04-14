<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaController extends Controller
{
    public function index($vehiculoId)
    {
        $data = array('vehiculoId' => $vehiculoId );
        return view('lecturas.index',$data);
    }

    
}
