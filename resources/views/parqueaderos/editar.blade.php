@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderosEditar', $parqueadero))
@section('content')


    <form action="{{ route('parqueaderosActualizar') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $parqueadero->id }}">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('parqueaderos.datos',['parqueadero'=>$parqueadero])
                    <div class="col-sm-4">
                        <p>Guardias<i class="text-danger">*</i></p>
                        @if ($guardias->count() > 0)
                            @foreach ($guardias as $guardia    )
                                <div class="form-check">
                                    <input type="checkbox" value="{{ $guardia->id }}" {{ $parqueadero->hasGuardia($guardia->id)?'checked':'' }}  name="guardias[{{ $guardia->id }}]"  class="form-check-input @error('guardias.'.$guardia->id) is-invalid @enderror" id="guardia-{{ $guardia->id }}">
                                    <label class="form-check-label" for="guardia-{{ $guardia->id }}">{{ $guardia->apellidos_nombres }}</label>
                                </div>
                            @endforeach
                        @else
                            @include('layouts.alert', [
                                'type' => 'info',
                                'msg' => 'No existe usuarios con rol guardia.!',
                            ])
                            <a href="{{ route('usuariosNuevo') }}">Crear uno nuevo</a>
                        @endif
                     
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Actualizar</button>
            </div>
        </div>

    </form>

@endsection
