<?php

namespace App\Http\Livewire\Reportes\Vehiculos;

use App\Models\OrdenMovilizacion;
use App\Models\TipoVehiculo;
use Livewire\Component;

class OrdenesVehiculos extends Component
{
    public $tiposVehiculos = [];
    public $ordenesMovilizacion = [];
    public $rangoDeFechas = 'MES';
    public function render()
    {
        $this->tiposVehiculos = TipoVehiculo::get();
        $this->ordenesMovilizacion = OrdenMovilizacion::get();
        $this->rangoDeFechas = rangoFechas('MES');
        return view('livewire.reportes.vehiculos.ordenes-vehiculos');
    }
}
