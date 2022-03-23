<?php

namespace App\Http\Livewire\OrdenMovilizacion;

use App\Models\Espacio;
use App\Models\Parqueadero;
use App\Models\Vehiculo as ModelsVehiculo;
use Livewire\Component;

class Vehiculo extends Component
{
    // public $parqueaderos;
    // public $espacios;
    public $idPar;

    public $foo;
    public $search = '';
    public $page = 1;
 
    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $parqueaderos=Parqueadero::has('espacios')->get();
        
        if($this->idPar){
            $ex=Parqueadero::find($this->idPar)->espacios;
        }else{
            $ex=$parqueaderos->first()->espacios??null;
        }
        if($ex){
            $espacios=ModelsVehiculo::whereIn('id',$ex->pluck('vehiculo_id'))
            ->where('numero_movil','like','%'.$this->search.'%')->get();
        }else{
            $espacios=ModelsVehiculo::where('numero_movil','like','%'.$this->search.'%')->get();
        }
        
        
        $data = array(
            'parqueaderos'=>$parqueaderos,
            'espacios'=>$espacios,
        );
        return view('livewire.orden-movilizacion.vehiculo',$data);
    }

    public function changeEvent($value)
    {
        $this->idPar=$value;
    }
}
