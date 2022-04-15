@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('perfil'))

{{-- @section('barraLateral')
    <div class="breadcrumb justify-content-center">
        <a href="#" class="breadcrumb-elements-item">
            <i class="icon-comment-discussion mr-2"></i>
            Support
        </a>

        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="icon-gear mr-2"></i>
                Settings
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
            </div>
        </div>
    </div>
@endsection --}}


@section('content')
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-vcard mr-2"></i> Información</a></li>
            <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-lock mr-2"></i> Contraseña</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="left-icon-tab1">
                <form action="{{ route('actualizarPerfil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('usuarios.datos',['user'=>$user])
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>

            <div class="tab-pane fade" id="left-icon-tab2">
                <form method="POST" action="{{ route('actualizarContrasena') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="contrasena" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña actual') }}</label>

                        <div class="col-md-6">
                            <input id="contrasena" type="password" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" required autocomplete="contrasena" autofocus>

                            @error('contrasena')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }} nueva</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }} nueva</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

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
