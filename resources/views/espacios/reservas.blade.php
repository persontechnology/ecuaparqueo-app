@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('estacionamientosReservas',$espacio))
@section('content')
    <!-- Simple text stats with icons -->


    <!-- /simple text stats with icons -->
    <div class="card" id="draggable-default-container">
        <div class="card-body">
            @include('espacios.calendar')
        </div>
    </div>
    <!-- /basic -->
    {{-- modal --}}

    @push('linksCabeza')
   
    @endpush

    @prepend('linksPie')
        <script>
          
      
        </script>

  
    @endprepend

@endsection
