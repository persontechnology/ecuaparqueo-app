<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\OrdenMovilizacionDataTable;
use App\Models\OrdenMovilizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlOrdenMovilizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Control Orden de Movilización']);
    }
    public function index()
    {
        return view('movilizacion.control.index');
    }
}
