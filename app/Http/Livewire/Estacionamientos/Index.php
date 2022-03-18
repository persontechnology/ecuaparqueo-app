<?php

namespace App\Http\Livewire\Estacionamientos;


use App\Models\Espacio;
use App\Models\Parqueadero;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;


    public  $parqueadero,
        $numero,
        $descripcion,
        $estado = false,
        $espacioId,
        $btnClear = false,
        $btnText = 'Registrar';
    public $lat = 'da',
        $lon = 'dsa';

    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';
    protected $initializeWithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '']
    ];
    public $search, $tipoVehiculo, $estadoParqueadero;
    public $perPage;
    public function mount(Parqueadero $parqueadero)
    {
        $this->parqueadero = $parqueadero;
    }
    public function render()
    {
        $tipos = TipoVehiculo::get();
        $espacios = Espacio::with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje'])->where('estado', '!=', 'Inactivo');
        if ($this->search && strlen($this->search) > 1) {
            $espacios = $espacios->whereHas('vehiculo', function ($q) {
                $q->where('placa', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->tipoVehiculo && $this->tipoVehiculo > 0 &&  $this->tipoVehiculo !== '') {
            $espacios = $espacios->whereHas('vehiculo.tipoVehiculo', function ($q) {
                $q->where('id', $this->tipoVehiculo);
            });
        }
        if ($this->estadoParqueadero && $this->estadoParqueadero !== '') {
            $espacios = $espacios->where('estado', $this->estadoParqueadero);
        }
        $espacios = $espacios->orderBy('numero', 'asc')
            ->paginate($this->perPage ? $this->perPage : '50');
        return view('livewire.estacionamientos.index', ['tipos' => $tipos, 'espacios' => $espacios]);
    }
    public function edit($id)
    {

        $espacio = Espacio::where('id', $id)->first();
        $this->espacioId = $espacio->id;
        $this->numero = 2;
    }
    public function showMap($id)
    {

        $vehiculo = Vehiculo::find($id);
        $url = "https://www.ecuatrack.com/WS/WSTrack2.asmx?wsdl";
        try {

            $client = new \SoapClient($url);
            $result = $client->GetCurrentPositionByIMEI(["SecurityToken" => 'a1bc4322-6c7e-4b02-9ff7-fe1904884257', "IMEI" => $vehiculo->imei]);
            $xml = simplexml_load_string($result->GetCurrentPositionByIMEIResult);
            $this->lat = $xml->Table->Lat;
        } catch (\SoapFault $e) {
            $this->lon =  $e->getMessage();
        }
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    private function resetInputFields()
    {
        $this->numero = '';
        $this->vehiculo_id = '';
    }
}
