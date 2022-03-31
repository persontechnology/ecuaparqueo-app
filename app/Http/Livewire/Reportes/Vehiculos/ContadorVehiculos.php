<?php

namespace App\Http\Livewire\Reportes\Vehiculos;


use App\Models\Espacio;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\Vehiculo;
use Livewire\Component;

class ContadorVehiculos extends Component
{
    public function render()
    {
        $contadorVehiculo=Vehiculo::count();
        $contadorParqueaderos=Parqueadero::count();
        $contadorEstacionamientro=Espacio::count();
        $contadorOrdenes=OrdenMovilizacion::count();
        $data=[
            'contadorVehiculo'=>$contadorVehiculo,
            'contadorParqueaderos'=>$contadorParqueaderos,
            'contadorEstacionamientro'=>$contadorEstacionamientro,
            'contadorOrdenes'=>$contadorOrdenes,
        ];

        return view('livewire.reportes.vehiculos.contador-vehiculos',['data'=>$data]);
    }
}
