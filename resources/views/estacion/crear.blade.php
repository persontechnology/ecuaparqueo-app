@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('estacion.create'))
@section('content')
<form action="{{ route('estacion.store') }}" method="POST">
    @csrf
    <div class="card">

        <div class="card-body">
            <fieldset>

                <div class="form-group">
                    <label for="nombre">Nombre<i class="text-danger">*</i></label>
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @if ($despachadores->count()>0)
                    <div class="form-group">
                        <label for="despachador">Selecione despachadores</label>
                        @foreach ($despachadores as $des)
                            <div class="form-check">
                                <input type="checkbox" value="{{$des->id}}" {{ old('despachador.'.$des->id)==$des->id ?'checked':'' }} name="despachador[{{ $des->id }}]"  class="form-check-input" id="des-0-{{ $des->id }}">
                                <label class="form-check-label" for="des-0-{{ $des->id }}">{{ $des->apellidos_nombres }}</label>
                            </div>
                        @endforeach
                    </div>
                @else
                    @include('layouts.alert',['type'=>'info','msg'=>'No existe usuarios con rol Despachador'])
                    <a href="{{ route('usuariosNuevo') }}">Crear nuevo usuario</a>
                @endif
            </fieldset>
        </div>
        <div class="card-footer bg-transparent">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

<form id="form-estacion-eliminar" action="" method="POST" class="d-none">
    @csrf
    @method('delete')
</form>


@push('scripts')
<script src="{{ asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
@endpush
@push('linksPie')
    <script>
        $('.multiselect').multiselect();

        function eliminarEstacion(arg){
            arg.preventDefault(); 
            $('#form-estacion-eliminar').attr('action',$(arg).data('url')).submit();
        }
    </script>
@endpush
@endsection
