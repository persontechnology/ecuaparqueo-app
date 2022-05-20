<?php

namespace App\Http\Controllers;

use App\DataTables\DespachoCombustible\ChoferDCDataTable;
use App\DataTables\DespachoCombustible\VehiculoDCDataTable;
use App\DataTables\DespachoCombustibleDataTable;
use App\Http\Requests\DespachoCombustible\RqEditar;
use App\Http\Requests\DespachoCombustible\RqGuardar;
use App\Models\DespachoCombustible;
use App\Notifications\DespachoCombustible\EnviarNotiChoferDespachoCombustible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class DespachoCombustibleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Despacho de combustible']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DespachoCombustibleDataTable $dataTable)
    {   
        return $dataTable->render('despachoCombustible.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create(ChoferDCDataTable $udt,VehiculoDCDataTable $pdt) {
        $data = array(
            'udt' => $udt,
            'pdt'=>$pdt,
            'numeroSiguente'=>DespachoCombustible::NumeroSiguente()
        );
        if (request()->get('table') == 'posts') {
            return $udt->render('despachoCombustible.crear', $data);
          }
        return $pdt->render('despachoCombustible.crear', $data);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RqGuardar $request)
    {
        $data = $request->all();
        $data['cantidad_galones'] = $request->galones;
        $data['chofer_id']=$request->conductor;
        $data['vehiculo_id']=$request->vehiculo;
        // $data['despachador_id']=$request->conductor;
        $data['autorizado_id']=Auth::user()->id;
        $data['estado']='Autorizado';
        
        try {
            $dc=DespachoCombustible::create($data);
            if($request->noti){
                $dc->conductor->notify(new EnviarNotiChoferDespachoCombustible($dc));
                request()->session()->flash('success','Despacho de combustible '.$dc->numero.' guardado. Se envío una notificación a '.$dc->conductor->email);    
            }else{
                request()->session()->flash('success','Despacho de combustible '.$dc->numero.' guardado');
            }
            return redirect()->route('despacho-combustible.show',$dc->id);
        } catch (\Throwable $th) {
            request()->session()->flash('info','Ocurrio un error, vuelva intentar o consulte con administrador'.$th->getMessage());
            return redirect()->route('despacho-combustible.create');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DespachoCombustible  $despachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function show(DespachoCombustible $despachoCombustible)
    {
        return view('despachoCombustible.ver',['dc'=>$despachoCombustible]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DespachoCombustible  $despachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function edit(ChoferDCDataTable $udt,VehiculoDCDataTable $pdt,DespachoCombustible $despachoCombustible)
    {
        $data = array(
            'udt' => $udt,
            'pdt'=>$pdt,
            'dc'=>$despachoCombustible,
            'numeroSiguente'=>$despachoCombustible->numero
        );
        if (request()->get('table') == 'posts') {
            return $udt->render('despachoCombustible.editar', $data);
        }
        return $pdt->render('despachoCombustible.editar', $data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DespachoCombustible  $despachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function update(RqEditar $request, DespachoCombustible $despachoCombustible)
    {
        $this->authorize('update',$despachoCombustible);
        $data = $request->all();
        $data['cantidad_galones'] = $request->galones;
        $data['chofer_id']=$request->conductor;
        $data['vehiculo_id']=$request->vehiculo;
        // $data['despachador_id']=$request->conductor;
        $data['autorizado_id']=Auth::user()->id;
        
        try {
            $despachoCombustible->fill($data)->save();
            if($request->noti){
                $despachoCombustible->conductor->notify(new EnviarNotiChoferDespachoCombustible($despachoCombustible));
                request()->session()->flash('success','Despacho de combustible '.$despachoCombustible->numero.' actualizado. Se envío una notificación a '.$despachoCombustible->conductor->email);    
            }else{
                request()->session()->flash('success','Despacho de combustible actualizado');
            }
            
        } catch (\Throwable $th) {
            request()->session()->flash('info','Ocurrio un error, vuelva intentar o cnsulte con administrador');
        }
        return redirect()->route('despacho-combustible.show',$despachoCombustible->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DespachoCombustible  $despachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function destroy(DespachoCombustible $despachoCombustible)
    {
        try {
            DB::beginTransaction();
            if($despachoCombustible->estado!='Despachado'){
                $dc=$despachoCombustible->delete();
                if($dc){
                    Storage::delete($despachoCombustible->foto);
                }
                request()->session()->flash('success','Despacho de combustible eliminado');
            }else{
                request()->session()->flash('info','No se puede eliminar en estado '.$despachoCombustible->estado);
            }
            DB::commit();
            return redirect()->route('despacho-combustible.index');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('Ocurrio un error, vuelva intentar o consulte con administrador.');
            return redirect()->route('despacho-combustible.show',$despachoCombustible->id);
        }
    }

    public function pdf($despachoCombustibleId)
    {
        $despachoCombustible=DespachoCombustible::findOrFail($despachoCombustibleId);
        $headerHtml = view()->make('empresa.pdfHeader',['titulo'=>'FORMULARIO AUTORIZACIÓN PARA EL DESPACHO DEL COMBUSTIBLE'])->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();
        $data = array('dc' => $despachoCombustible);

       $pdf = PDF::loadView('despachoCombustible.pdf',$data)
        // ->setOrientation('landscape')
        ->setOption('margin-top', '3cm')
        ->setOption('margin-bottom', '1cm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline('FORM-ADC- '.$despachoCombustible->numero.'.pdf');
    }
}
