@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('controlOdernMovilizacion'))

@section('barraLateral')

@endsection
@section('content')

<div class="card card-body">
    
    <div class="table-responsive">
        {{$dataTable->table()}}
    </div>
</div>
@push('scripts')
    {{$dataTable->scripts()}}
  
    <script>
        function cambiarEstado(arg) {

            var url = $(arg).data('url');
            var id = $(arg).data('id');
            
            var form = document.createElement("form");
            var element1 = document.createElement("input");
            var element2 = document.createElement("input");
            form.method = "POST";
            form.action = url;
            element1.value = "{{ csrf_token() }}";
            element1.name = "_token";
            form.appendChild(element1);
            element2.value = id;
            element2.name = "id";
            form.appendChild(element2);
            document.body.appendChild(form);
            form.submit();

        }
    </script>
@endpush
@endsection
