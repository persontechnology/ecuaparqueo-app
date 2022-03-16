<?php

namespace App\Http\Controllers;

use App\Http\Requests\Espacios\RqGuardar;
use App\Models\Espacio;
use App\Models\OrdenMovilizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EspacioController extends Controller
{
    public function guardar(RqGuardar $request)
    {
        $espacioObj = Espacio::where(['parqueadero_id' => $request->parqueadero_id])->orderBy('created_at', 'desc')->limit(1)->first();

        $espacio = new Espacio();
        $espacio->numero = $request->numero;
        $espacio->vehiculo_id = $request->vehiculo_id;
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
        $url = "http://ws.cdyne.com/ip2geo/ip2geo.asmx?wsdl";
        try {
            $client = new \SoapClient($url, ["trace" => 1]);
            $result = $client->ResolveIP(["SecurityToken" => 'a1bc4322-6c7e-4b02-9ff7-fe1904884257', "IMEI" => "864802030794840"]);
            return ($result);
        } catch (\SoapFault $e) {
            return  $e->getMessage();
        }
        echo PHP_EOL;
        return view('espacios.mapa', ['espacio' => $espacio]);
    }
}
