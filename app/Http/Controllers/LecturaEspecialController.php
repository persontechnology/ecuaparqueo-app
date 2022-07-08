<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaEspecialController extends Controller
{
    public function index()
    {
       return view('lecturas.especial.index');
    }
}
