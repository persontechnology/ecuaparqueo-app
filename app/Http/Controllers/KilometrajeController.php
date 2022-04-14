<?php

namespace App\Http\Controllers;

use App\DataTables\KilometrajeDataTable;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class KilometrajeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Vehículos']);
    }
    public function index(KilometrajeDataTable $dataTable,$vehiculoId)
    {
        $vehiculo=Vehiculo::findOrFail($vehiculoId);
        return $dataTable->with('vehiculo',$vehiculo)->render('kilometrajes.index',['vehiculo'=>$vehiculo]);
    }
}
