<?php

namespace App\Http\Livewire\OrdenMovilizacionControl;

use App\Models\Espacio;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\TipoVehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class Listado extends Component
{
 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // para filtros
    public $IdTipoVehiculo;
    public $EstadoOrdenMovilizacion;
    public $NumeroOrden;
    public $IdParqueadero;

    // querys
    protected $queryString = [
        'NumeroOrden' => ['except' => '','as'=>'orden'],
        'IdTipoVehiculo'=>['except' => '','as'=>'tipovehiculo'],
        'EstadoOrdenMovilizacion'=>['except' => '','as'=>'estado'],
        'IdParqueadero'=>['except' => '','as'=>'parqueadero'],
        // 'page'=>['as'=>'pagina']
    ];

    public function render()
    {
        
        $vehiculosIds=Espacio::where('parqueadero_id','like','%'.$this->IdParqueadero.'%')->pluck('vehiculo_id');

        $ordenMovilizaciones=OrdenMovilizacion::whereIn('vehiculo_id',$vehiculosIds)
        ->where('numero', 'like', '%'.$this->NumeroOrden.'%')
        ->where('estado','like','%'.$this->EstadoOrdenMovilizacion.'%')
        ->whereHas('vehiculo',function($query) {
            $query->whereRaw("tipo_vehiculo_id like ?",["%{$this->IdTipoVehiculo}%"]);
        })->paginate(10);

        //$this->ordenMovilizaciones=OrdenMovilizacion::paginate(10);
        $tipoVehiculos=TipoVehiculo::get();
        $parqueaderos=Parqueadero::get();

        $data = array(
            'ordenMovilizaciones'=>$ordenMovilizaciones,
            'tipoVehiculos'=>$tipoVehiculos,
            'parqueaderos'=>$parqueaderos,
        );



        return view('livewire.orden-movilizacion-control.listado',$data);
    }

    public function updatingNumeroOrden()
    {
        $this->resetPage();
    }
    

    public function updatedIdTipoVehiculo($value)
    {
        
        $this->IdTipoVehiculo=$value;
    }

    public function updatedEstadoOrdenMovilizacion($value)
    {
        $this->EstadoOrdenMovilizacion=$value;
    }

    public function updatedIdParqueadero($value)
    {
        
        $this->IdParqueadero=$value;

    }
}
