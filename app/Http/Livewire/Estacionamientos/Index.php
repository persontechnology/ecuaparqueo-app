<?php

namespace App\Http\Livewire\Estacionamientos;

use App\Models\Empresa;
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
    public $lat = null,
        $lon = null,
        $vehiculo,
        $mensaje;

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
        $espacios = Espacio::with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje'])->where('estado', '!=', 'Inactivo')
            ->where('parqueadero_id', $this->parqueadero->id);
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

        $this->vehiculo = Vehiculo::with('tipoVehiculo')->find($id);
        $empresa = Empresa::first();
        $url =  $empresa->url_web_gps;
        try {

            $client = new \SoapClient($url);
            $result = $client->GetCurrentPositionByIMEI(["SecurityToken" => $empresa->token ?? '', "IMEI" => $this->vehiculo->imei]);
            $xml = simplexml_load_string($result->GetCurrentPositionByIMEIResult);
            $this->lat = strval($xml->Table->Lat);
            $this->lon = strval($xml->Table->Lon);
        } catch (\SoapFault $e) {
            $this->mensaje = "No se puede mostrar  la información de la ubicación verifíque los datos de conexión y vuelava ha intentar";
            return;
        }
        $this->dispatchBrowserEvent('openPagamentoLongModal');
        $this->dispatchBrowserEvent('cargarMapaEvent');
    }
    public function updatingLon($event)
    {
        $this->mensaje = "noo";
        //$this->dispatchBrowserEvent('openPagamentoLongModal');
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
