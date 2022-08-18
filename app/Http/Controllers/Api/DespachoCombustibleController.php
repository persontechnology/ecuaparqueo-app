<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DespachoCombustible;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DespachoCombustibleController extends Controller
{
    public function consulta(Request $request)
    {
        $request->validate([
            'placa'=>'required|string|max:8',
            'codigo'=>'required|string|max:6'
        ]);

        $veh=Vehiculo::where('placa',$request->placa)->orWhere('numero_movil',$request->placa)->first();
        if(!$veh){
            throw ValidationException::withMessages([
                'placa' => ['No existe vehículo '.$request->placa],
            ]); 
        }else{
            $dc=DespachoCombustible::where(['vehiculo_id'=>$veh->id,'codigo'=>$request->codigo,'estado'=>'Autorizado'])->first();
            if(!$dc){
                throw ValidationException::withMessages([
                    'codigo' => ['No existe autorización'],
                ]); 
            }else{
                $data = array(
                    "cantidad_galones"=> $dc->cantidad_galones,
                    "cantidad_letras"=> $dc->cantidad_letras,
                    "chofer"=> $dc->conductor->apellidos_nombres,
                    "chofer_id"=> $dc->chofer_id,
                    "codigo"=> $dc->codigo,
                    "concepto"=> $dc->concepto,
                    "destino"=> $dc->destino,
                    "estado"=> $dc->estado,
                    "fecha"=> $dc->fecha,
                    "id"=> $dc->id,
                    "kilometraje"=> $dc->kilometraje,
                    "numero"=> $dc->numero,
                    "observaciones"=> $dc->observaciones,
                    "valor"=> $dc->valor,
                    "valor_letras"=> $dc->valor_letras,
                    "vehiculo"=> $request->placa,
                 );
                return response()->json($data);
            }
        }
    }
    public function consultaEstaciones(Request $request)
    {
        return $request->user()->estacionServicios;
    }

    public function guardarFoto(Request $request)
    {
        $request->validate([
            'estacion'=>'required',
            'foto'=>'required|image',
        ]);
        try {
            DB::beginTransaction();
            $dc=DespachoCombustible::find($request->id);
            if ($request->hasFile('foto')) {
                $archivo = $request->file('foto');
                 if ($archivo->isValid()) {
                    Storage::delete($dc->foto);
                    $path = Storage::putFileAs(
                        'public/dc',
                        $archivo,
                        $dc->id.'.'. $archivo->extension()
                    );
                    $dc->foto=$path;
                }
                
            }
        
            $dc->estado='Despachado';
            $dc->fecha_despacho=Carbon::now();
            $dc->despachador_id=$request->user()->id;
            $dc->estacion_id=$request->estacion;
            $dc->save();
            DB::commit();
            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('no');
        }
    }
}
