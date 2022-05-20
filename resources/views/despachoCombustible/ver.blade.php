@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('despacho-combustible.show',$dc))
@section('barraLateral')
<div class="breadcrumb justify-content-center">
    
    
    
</div>
<div class="breadcrumb justify-content-center">
    <a href="{{ route('despacho-combustible.pdf',$dc->id) }}" target="_blanck" class="breadcrumb-elements-item">
        <i class="fa-solid fa-file-pdf mr-1 text-warning"></i>PDF
    </a>

    <div class="breadcrumb-elements-item dropdown p-0">
        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
            <i class="icon-gear mr-2"></i>Acción
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('despacho-combustible.edit',$dc->id) }}" class="dropdown-item">
                <i class="fa-solid fa-pen-to-square text-primary"></i>Editar
            </a>
            <a href="#" onclick="event.preventDefault();eliminarR(this);" data-url="{{ route('despacho-combustible.destroy',$dc->id) }}" data-msg="Está seguro de eliminar {{ $dc->numero }}!" class="dropdown-item">
                <i class="fa-solid fa-trash text-danger"></i> Eliminar
            </a>
        </div>
    </div>
</div>

@endsection
@section('content')
<div class="card">
    <div class="card-header">
        @include('empresa.pdfHeaderServer',['titulo'=>'FORMULARIO AUTORIZACIÓN PARA EL DESPACHO DE COMBUSTIBLE'])
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @include('despachoCombustible.table',['dc'=>$dc,'fotoPdf'=>'NO'])
        </div>
    </div>
</div>

@endsection
