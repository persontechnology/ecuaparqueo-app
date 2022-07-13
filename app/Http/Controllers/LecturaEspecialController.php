<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaEspecialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Lecturas entradas y salidas']);
    }
    public function index()
    {
       return view('lecturas.especial.index');
    }
}
