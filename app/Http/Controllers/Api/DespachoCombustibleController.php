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
        try {
            DB::beginTransaction();
            $dc=DespachoCombustible::find($request->id);
            $code_base64 = str_replace('data:image/jpg;base64,','',$request->foto);
            $code_binary = base64_decode($code_base64);
            $path='public/dc/'.$dc->id.'.png';
            Storage::delete($dc->foto);
            Storage::put($path, $code_binary);
            $dc->foto=$path;
            $dc->estado='Despachado';
            $dc->fecha_despacho=Carbon::now();
            $dc->despachador_id=$request->user()->id;
            $dc->estacion_id=$request->service;
            $dc->save();
            DB::commit();
            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('no');
        }
    }
}
