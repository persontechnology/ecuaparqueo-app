<?php
namespace App\Http\Livewire\Lecturas\Especial;

use App\Models\LecturaEspecial;
use Livewire\Component;
use PDF;
use Carbon\Carbon;
use Livewire\WithPagination;
class Index extends Component
{

    public $mostrar='10';
    public $desde;
    public $hasta;
    public $tipoLectura;
    public $numeroPlaca;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'mostrar'=>['except'=>'10'],
        'desde'=>['except' => '','as'=>'fi'],
        'hasta'=>['except' => '','as'=>'ff'],
        'tipoLectura'=>['except' => '','as'=>'tl'],
        'numeroPlaca' => ['except' => '','as'=>'np'],
    ];

    public function render()
    {
        $data = array(
            'lecturasNormales'=>$this->listadoLecturas(),
        );
        return view('livewire.lecturas.especial.index',$data);
    }

    public function listadoLecturas()
    {
        return LecturaEspecial::where(function($query){
            if($this->desde && $this->hasta){
                $query->whereDate('created_at','>=', $this->desde);
                $query->whereDate('created_at','<=', $this->hasta);
            }
            if($this->tipoLectura){
                $query->where('tipo','like','%'.$this->tipoLectura.'%');
            }
            if($this->numeroPlaca){
                
                $query->whereHas('vehiculo',function($query) {
                    $query->where('numero_movil', 'like', '%'.$this->numeroPlaca.'%');
                    $query->orWhere('placa', 'like', '%'.$this->numeroPlaca.'%');
                });
            }
        })->latest()->paginate($this->mostrar);
    }

    public function updatedMostrar($value)
    {
        $this->mostrar=$value;
    }

    public function updatedTipoLectura($value)
    {
        $this->tipoLectura=$value;
    }
    public function pdf()
    {
        $lecturasNormales=$this->listadoLecturas();
        $headerHtml = view()->make('empresa.pdfHeader',['titulo'=>'LECTURAS DE VEHÍCULOS ESPECIALES'])->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();

        $data = array('lecturasNormales' => $lecturasNormales);

        
       $pdf = PDF::loadView('livewire.lecturas.especial.listadoPfd',$data)
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
            "LecturaNormal".Carbon::now().".pdf"
       );

    }

    
}
