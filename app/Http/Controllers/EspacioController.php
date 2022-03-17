<?php

namespace App\Http\Controllers;

use App\Http\Requests\Espacios\RqGuardar;
use App\Models\Espacio;
use App\Models\OrdenMovilizacion;
use App\Models\Vehiculo;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;

class EspacioController extends Controller
{
    public function guardar(RqGuardar $request)
    {
        $espacioObj = Espacio::where(['parqueadero_id' => $request->parqueadero_id])->orderBy('created_at', 'desc')->limit(1)->first();

        $espacio = new Espacio();
        $espacio->numero = $request->numero;
        $espacio->vehiculo_id = $request->vehiculo_id;
        $espacio->estado = 'Presente';
        $espacio->parqueadero_id = $request->parqueadero_id;
        $espacio->left = $espacioObj->left ?? 26;
        $espacio->top = $espacioObj->top ?? 10;
        $espacio->user_create = Auth::user()->id;
        $espacio->save();
        request()->session()->flash('success', 'Estacionamiento creada');
        return redirect()->route('parqueaderosListaEspacios', $espacio->parqueadero_id);
    }
    public function actualizarTodos(Request $request)
    {
        $data = $request->validate([
            'espacios*' => 'required'
        ]);

        foreach ($request['espacios'] as $establecimiento) {
            $actualizarEstablecimiento = Espacio::find($establecimiento['id']);
            if ($actualizarEstablecimiento) {
                $actualizarEstablecimiento->left = $establecimiento['left'];
                $actualizarEstablecimiento->top = $establecimiento['top'];
                $actualizarEstablecimiento->save();
            }
        }
        return response()->json(['tipo' => 'success', 'msj' => "Datos  actualizados exitosamente..."]);
    }
    public function listarReservaVehiculo(Request $request, Espacio $espacio)
    {
        //return $espacio;
        $startDate = $request->dateStart ? $request->dateStart : Carbon::now()->startOfMonth();
        $endDate = $request->dateEnd ? $request->dateEnd : Carbon::now()->endOfMonth();
        $reservas = OrdenMovilizacion::where(['vehiculo_id' => $espacio->vehiculo_id, 'estado' => 'Aceptada'])->get();
        /*         ->whereDate("events.start_date_time", ">=", $startDate)
        ->whereDate("events.end_date_time", "<=", $endDate)->get(); */

        return view('espacios.reservas', ['reservas' => $reservas, 'espacio' => $espacio]);
    }

    public function verVehiculoMapa(Request $request, Espacio $espacio)
    {
        $vehiculo=Vehiculo::find($espacio->vehiculo_id);
        $url = "https://www.ecuatrack.com/WS/WSTrack2.asmx?wsdl";
        $lat = null;
        $lon = null;
        try {
            $client = new \SoapClient($url);
            $result = $client->GetCurrentPositionByIMEI(["SecurityToken" => 'a1bc4322-6c7e-4b02-9ff7-fe1904884257', "IMEI" => $vehiculo->imei]);
            $xml = simplexml_load_string($result->GetCurrentPositionByIMEIResult);

            $lat = $xml->Table->Lat;
            $lon = $xml->Table->Lon;
            //return (str_ireplace('><', ">\n<",$result->GetAllCompaniesResult));
        } catch (\SoapFault $e) {
            return  $e->getMessage();
        }
        return view('espacios.mapa', ['espacio' => $espacio, 'lat' => $lat, 'lon' => $lon]);
    }
}
