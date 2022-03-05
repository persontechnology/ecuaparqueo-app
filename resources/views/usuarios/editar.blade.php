@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('usuariosEditar',$user))


@section('content')

<!-- 2 columns form -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('actualizarUsuario') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}" required>
            <div class="row">
                <div class="col-lg-8">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-address-card"></i> Detalle personal</legend>
                    @include('usuarios.datos',['user'=>$user])
                </div>

                <div class="col-lg-4">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-key"></i> Roles</legend>
                    <fieldset>
                        @foreach ($roles as $rol    )
                            <div class="form-check">
                                <input type="checkbox" value="{{ $rol->id }}" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} name="roles[{{ $rol->id }}]"  class="form-check-input @error('roles.'.$rol->id) is-invalid @enderror" id="rol-{{ $rol->id }}">
                                <label class="form-check-label" for="rol-{{ $rol->id }}">{{ $rol->name }}</label>
                            </div>
                            
                        @endforeach
                       
                    </fieldset>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
<!-- /2 columns form -->

@endsection
