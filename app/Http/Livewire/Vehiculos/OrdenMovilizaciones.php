<?php

namespace App\Http\Livewire\Vehiculos;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use PDF;
class OrdenMovilizaciones extends Component
{
    public $vehiculo;


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // para filtros
    
    public $EstadoOrdenMovilizacion;
    public $NumeroOrden;
    public $desde;
    public $hasta;
    public $mostrar='10';
    // querys
    protected $queryString = [
        'NumeroOrden' => ['except' => '','as'=>'orden'],
        'EstadoOrdenMovilizacion'=>['except' => '','as'=>'estado'],
        'desde'=>['except' => '','as'=>'fi'],
        'hasta'=>['except' => '','as'=>'ff'],
        'mostrar'=>['except'=>'10']
    ];

    public function render()
    {
        $data = array(
            'vehiculo' => $this->vehiculo,
            'ordenMovilizaciones'=>$this->listadoOrdenes(),
        );
        
        return view('livewire.vehiculos.orden-movilizaciones',$data);
    }

    public function listadoOrdenes(){
    
        $ordenMovilizaciones=$this->vehiculo->ordenesMovilizaciones()->where(function ($query) {
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
        })->latest()->paginate($this->mostrar);
        
        return $ordenMovilizaciones;
    }

    public function updating()
    {
        $this->resetPage();
    }
    public function updatedEstadoOrdenMovilizacion($value)
    {
        $this->EstadoOrdenMovilizacion=$value;
    }
    public function updatedMostrar($value)
    {
        $this->mostrar=$value;
    }

    public function pdf()
    {
        $ordenes=$this->listadoOrdenes();
        $headerHtml = view()->make('empresa.pdfHeader',['titulo'=>'ORDENES DE MOVILIZACIÓN DENTRO DEL ÁREA DE CONSECIÓN DEL VEHÍCULO '.$this->vehiculo->numero_movil_placa??''])->render();
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
