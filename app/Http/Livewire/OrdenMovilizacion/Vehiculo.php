<?php

namespace App\Http\Livewire\OrdenMovilizacion;

use App\Models\Espacio;
use App\Models\Parqueadero;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Color\BIFF5;

class Vehiculo extends Component
{
    public $parqueaderos;
    public $espacios;
    public $idPar;

    public $search;

    
    public function mount()
    {
        $this->parqueaderos=Parqueadero::get();
        $this->idPar=$this->parqueaderos->first()->id??null;
        if($this->idPar){
            $this->espacios = $this->parqueaderos->first()->espacios()->with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje'])->get();
        }
        
        
    }
    public function render()
    {
        return view('livewire.orden-movilizacion.vehiculo');
    }

    public function changeEvent($value)
    {
       $this->idPar = $value?$value:$this->parqueaderos->first()->id;
        $value?$this->espacios = Parqueadero::find($value)->espacios()->with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje'])->get():null;    
    }
}
