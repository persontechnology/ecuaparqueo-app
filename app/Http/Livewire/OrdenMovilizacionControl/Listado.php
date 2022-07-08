<?php

namespace App\Http\Livewire\OrdenMovilizacionControl;

use App\Models\Espacio;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\TipoVehiculo;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use PDF;

class Listado extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // para filtros
    public $IdTipoVehiculo;
    public $EstadoOrdenMovilizacion;
    public $NumeroOrden;
    public $IdParqueadero;
    public $desde;
    public $hasta;
    public $mostrar='10';
    // querys
    protected $queryString = [
        'NumeroOrden' => ['except' => '','as'=>'orden'],
        'IdTipoVehiculo'=>['except' => '','as'=>'tipovehiculo'],
        'EstadoOrdenMovilizacion'=>['except' => '','as'=>'estado'],
        'IdParqueadero'=>['except' => '','as'=>'parqueadero'],
        'desde'=>['except' => '','as'=>'fi'],
        'hasta'=>['except' => '','as'=>'ff'],
        'mostrar'=>['except'=>'10']
    ];

    public function render()
    {
        $data = array(
            'ordenMovilizaciones'=>$this->listadoOrdenes(),
            'tipoVehiculos'=>TipoVehiculo::get(),
            'parqueaderos'=>Parqueadero::get(),
        );
        return view('livewire.orden-movilizacion-control.listado',$data);
    }

    public function listadoOrdenes(){
        $vehiculosIds=Espacio::where('parqueadero_id','like','%'.$this->IdParqueadero.'%')->pluck('vehiculo_id');

        $ordenMovilizaciones=OrdenMovilizacion::where(function ($query) use($vehiculosIds) {
            if($vehiculosIds){
                $query->whereIn('vehiculo_id',$vehiculosIds);
            }
            if($this->desde && $this->hasta){
                $query->whereDate('fecha_salida','>=', $this->desde);
                $query->whereDate('fecha_retorno','<=', $this->hasta);
            }
            if($this->NumeroOrden){
                $query->where('numero', 'like', '%'.$this->NumeroOrden.'%');
            }
            if($this->EstadoOrdenMovilizacion){
                $query->where('estado','like','%'.$this->EstadoOrdenMovilizacion.'%');
            }
        })
        ->whereHas('vehiculo',function($query) {
            $query->whereRaw("tipo_vehiculo_id like ?",["%{$this->IdTipoVehiculo}%"]);
        })->latest()->paginate($this->mostrar);
        
        return $ordenMovilizaciones;
    }

    public function updating()
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
    public function updatedMostrar($value)
    {
        $this->mostrar=$value;
    }

    public function pdf()
    {
        $ordenes=$this->listadoOrdenes();
        $headerHtml = view()->make('empresa.pdfHeader')->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();

        $data = array('ordenes' => $ordenes);

        
       $pdf = PDF::loadView('livewire.orden-movilizacion.listadoPfd',$data)
        ->setOrientation('landscape')
        ->setOption('margin-top', '2.5cm')
        ->setOption('margin-bottom', '1cm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml)
        ->setOption('footer-right', 'Página [page] de [toPage]')
        ->setOption('footer-font-size', '10')
        ->output();
        // return $pdf->download('Orden '.Carbon::now().'.pdf');

        return response()->streamDownload(
            fn () => print($pdf),
            "Orden".Carbon::now().".pdf"
       );

    }
}
