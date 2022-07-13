<?php

namespace App\Http\Controllers;

use App\Models\LecturaInvitado;
use Illuminate\Http\Request;

class LecturaInvitadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Lecturas entradas y salidas']);
    }
    public function index()
    {
       return view('lecturas.invitado.index');
    }
}
