<?php

namespace App\Http\Controllers;
use App\Http\Requests\Espacios\RqGuardar;
use App\Models\Empresa;
use App\Models\Espacio;
use App\Models\Parqueadero;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class EspacioController extends Controller
{
    public function index($parqueaderoId)
    {
        $parqueadero=Parqueadero::findOrFail($parqueaderoId);
        $vehiculosIngresados=Espacio::whereNotNull('vehiculo_id')->pluck('vehiculo_id');
        $vehiculos=Vehiculo::whereNotIn('id',$vehiculosIngresados)->get();
        $data = array('parqueadero' => $parqueadero,'vehiculos'=>$vehiculos );
        return view('espacios.index',$data);
    }

    public function crearRangoEspacio(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:parqueaderos,id',
            'rango'=>'required|numeric|gt:0|max:500'
        ]);
        try {
            DB::beginTransaction();
            for ($i=1; $i <=$request->rango ; $i++) { 
                $espacio=new Espacio();
                $espacio->numero = $i;
                $espacio->estado = 'Presente';
                $espacio->parqueadero_id = $request->id;
                $espacio->user_create = Auth::user()->id;
                $espacio->save();
            }
            DB::commit();
            request()->session()->flash('success', $request->rango.' espacios registrados exitosamente');
        } catch (\Throwable $th) {
            request()->session()->flash('info', 'Ocurrio un error, contacte con administrador, o vuelva intentar.!');
            DB::rollback();
        }
        return redirect()->route('espacios', $request->id);
    }

    public function actualizarVehiculo(Request $request)
    {
        $esp=Espacio::find($request->id);
        $esp->vehiculo_id=$request->vehiculo??null;
        $esp->save();
        request()->session()->flash('success','Espacio actualizado');
        return redirect()->route('espacios',$esp->parqueadero->id);
    }

    public function nuevo($parqueaderoId)
    {
        $parqueadero=Parqueadero::findOrFail($parqueaderoId);
        $vehiculosIngresados=Espacio::whereNotNull('vehiculo_id')->pluck('vehiculo_id');
        $vehiculos=Vehiculo::whereNotIn('id',$vehiculosIngresados)->get();
        $data = array('parqueadero' => $parqueadero,'vehiculos'=>$vehiculos );
        return view('espacios.nuevo',$data);
    }


    public function guardar(RqGuardar $request)
    {
        
        $espacio = new Espacio();
        $espacio->numero = $request->numero;
        $espacio->vehiculo_id = $request->vehiculo_id;
        $espacio->estado = 'Presente';
        $espacio->parqueadero_id = $request->parqueadero_id;
        $espacio->user_create = Auth::user()->id;
        $espacio->save();
        request()->session()->flash('success', 'Estacionamiento creada');
        return redirect()->route('parqueaderosListaEspacios', $espacio->parqueadero_id);
    }
    
    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:espacios,id'
        ]);
        $espacio=Espacio::find($request->id);
        try {
            DB::beginTransaction();
            $espacio->delete();
            DB::commit();
            request()->session()->flash('success','Espacio eliminado');
        } catch (\Throwable $th) {
            request()->session()->flash('success','No puede eliminar ya que contiene información relacionada, contacte con administrador o vuelva intentar.');
            DB::rollback();
        }
        return redirect()->route('espacios',$espacio->parqueadero->id);
    }

    public function pdf($parqueaderoId)
    {
        $parqueadero=Parqueadero::findOrFail($parqueaderoId);
        $vehiculosIngresados=Espacio::whereNotNull('vehiculo_id')->pluck('vehiculo_id');
        $vehiculos=Vehiculo::whereNotIn('id',$vehiculosIngresados)->get();


        $headerHtml = view()->make('empresa.pdfHeader',['titulo'=>'Listado de espacio en parqueadero '.$parqueadero->nombre])->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();
        $data = array('parqueadero' => $parqueadero,'vehiculos'=>$vehiculos );
        $pdf = PDF::loadView('espacios.pdf',$data)

        ->setOrientation('landscape')
        ->setOption('margin-top', '2.5cm')
        ->setOption('margin-bottom', '1cm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline('Parqueadero '.$parqueadero->nombre.'.pdf');

    }

    public function ubicacionMapa($vehiculoId)
    {
        $vehiculo=Vehiculo::findOrFail($vehiculoId);
        $empresa=Empresa::first();
        $url = $empresa->url_web_gps;
        $lat = null;
        $lon = null;
        try {
            $client = new \SoapClient($url);
            $result = $client->GetCurrentPositionByIMEI(["SecurityToken" => $empresa->token, "IMEI" => $vehiculo->imei]);
            $xml = simplexml_load_string($result->GetCurrentPositionByIMEIResult);
            $lat = $xml->Table->Lat;
            $lon = $xml->Table->Lon;
        } catch (\SoapFault $e) {
            return  $e->getMessage();
        }
        return view('vehiculos.mapa', ['lat' => $lat, 'lon' => $lon]);
    }

   
}
