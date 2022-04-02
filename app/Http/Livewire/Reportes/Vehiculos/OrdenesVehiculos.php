<?php

namespace App\Http\Livewire\Reportes\Vehiculos;

use App\Models\TipoVehiculo;
use Livewire\Component;

class OrdenesVehiculos extends Component
{
    public function render()
    {
        $tipos = TipoVehiculo::get();
        return view('livewire.reportes.vehiculos.ordenes-vehiculos',['tipos'=>$tipos]);
    }
}
