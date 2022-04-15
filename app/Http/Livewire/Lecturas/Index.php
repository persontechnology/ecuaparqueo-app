<?php

namespace App\Http\Livewire\Lecturas;

use App\Models\Vehiculo;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $vehiculoId;

    public $desde;
    public $hasta;
    public $mostrar='10';
    // querys
    protected $queryString = [
        'desde'=>['except' => '','as'=>'fi'],
        'hasta'=>['except' => '','as'=>'ff'],
        'mostrar'=>['except'=>'10']
    ];

    public function render()
    {
        $data = array('lecturas' => $this->lista() );
        return view('livewire.lecturas.index',$data);
    }

    public function lista()
    {
        return Vehiculo::find($this->vehiculoId)->lecturas()->latest()->where(function($q){
            if($this->desde && $this->hasta){
                $q->whereDate('created_at','>=', $this->desde);
                $q->whereDate('fecha_retorno','<=', $this->hasta);
            }
        })->paginate($this->mostrar);
    }
    public function updating()
    {
        $this->resetPage();
    }

    public function pdf()
    {
        $lecturas=$this->lista();
        $headerHtml = view()->make('empresa.pdfHeader',['titulo'=>'LECTURA ORDEN DE MOVILIZACIÓN'])->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();

        $data = array('lecturas' => $lecturas);

        
       $pdf = PDF::loadView('livewire.lecturas.pdf',$data)
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
            "Lecturas ".Carbon::now().".pdf"
       );

    }
}
