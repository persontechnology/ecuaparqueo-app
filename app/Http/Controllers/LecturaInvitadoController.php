<?php

namespace App\Http\Controllers;

use App\Models\LecturaInvitado;
use Illuminate\Http\Request;

class LecturaInvitadoController extends Controller
{
    public function index()
    {
       return view('lecturas.invitado.index');
    }
}
