@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('usuariosEditar',$user))


@section('content')

<form action="{{ route('actualizarUsuario') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    <div class="card">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}" required>
            <div class="row">
                <div class="col-lg-8">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-address-card"></i> Detalle personal</legend>
                    @include('usuarios.datos',['user'=>$user])
                </div>
                

                <div class="col-lg-4">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-key"></i> Roles<i class="text-danger">*</i></legend>
                    <fieldset>
                        @foreach ($roles as $rol    )
                            <div class="form-check">
                                <input type="checkbox" value="{{ $rol->id }}" {{ $user->hasRole($rol)?'checked':'' }}  name="roles[{{ $rol->id }}]"  class="form-check-input @error('roles.'.$rol->id) is-invalid @enderror" id="rol-{{ $rol->id }}">
                                <label class="form-check-label" for="rol-{{ $rol->id }}">{{ $rol->name }}</label>
                            </div>
                            
                        @endforeach
                        
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

@push('linksCabeza')
<link rel="stylesheet" href="{{ asset('js/intl-tel-input/css/intlTelInput.min.css') }}">
<script src="{{ asset('js/intl-tel-input/js/intlTelInput.min.js') }}"></script>

{{--estilo para formato del telefono --}}
<style>
    .iti__flag {background-image: url("{{ asset('js/intl-tel-input/img/flags.png') }}");}

    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {background-image: url("{{ asset('js/intl-tel-input/img/flags@2x.png') }}");}
    }
</style>
@endpush

@prepend('linksPie')

<script>
  


        var input = document.querySelector("#telefono"),
        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Número no válido", "Código de país no válido", "Demasiado corto", "Demasiado largo", "Número no válido"];

        // initialise plugin
        var iti = window.intlTelInput(input, {
            autoHideDialCode:false,
            nationalMode:false,
            placeholderNumberType:"MOBILE",
            preferredCountries: ["ec" ],
            separateDialCode:false,
            utilsScript: "{{ asset('js/intl-tel-input/js/utils.js') }}"
        });

        var reset = function() {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()) {
            if (iti.isValidNumber()) {
            validMsg.classList.remove("hide");
            
            } else {
            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
            }
        }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

</script>
@endprepend
@endsection
