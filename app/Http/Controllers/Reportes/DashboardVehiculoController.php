<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Brazo;
use App\Models\User;
use App\Models\Vehiculo;
use App\Notifications\RealTimeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardVehiculoController extends Controller
{
    public function index()
    {
        return view('Reportes.Dashboard.vehiculos');
    }
    public function obtenerBrazo(Request $request)
    {
       
    }
    public function cerrarBrazo(Request $request)
    {
    }

    public function buscarVehiculoTarjeta(Request $request)
    {
        
    }
}
