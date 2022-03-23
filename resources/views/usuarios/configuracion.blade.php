@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('perfil'))


@section('content')
<form action="{{ route('actualizarConfiguracion') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <fieldset>

                <div class="form-group">
                    <label for="tema">Tema:</label>
                    <select name="tema" required id="tema" class="form-control form-control-select2">
                        @foreach ($configuracion->color_tema as $tema)
                            <option value="{{ $tema }}" {{ $configuracion->tema==$tema?'selected':'' }}>{{ $tema }}</option> 
                        @endforeach    
                    </select>
                    
                </div>
                <div class="form-group">
                    <p class="font-weight-semibold">Reducción</p>
                    <div class="border p-3 rounded">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="1" name="reduccion" id="dr_li_c" {{ $configuracion->reduccion==true?'checked':'' }}>
                            <label class="form-check-label" for="dr_li_c">SI</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="0" name="reduccion" id="dr_li_u" {{ $configuracion->reduccion==false?'checked':'' }}>
                            <label class="form-check-label" for="dr_li_u">NO</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <p class="font-weight-semibold">Menu</p>
                    <div class="border p-3 rounded">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="dark" name="menu" id="dr_li_c_dark" {{ $configuracion->menu=='dark'?'checked':'' }}>
                            <label class="form-check-label" for="dr_li_c_dark">Dark</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="light" name="menu" id="dr_li_u_light" {{ $configuracion->menu=='light'?'checked':'' }}>
                            <label class="form-check-label" for="dr_li_u_light">Light</label>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

@endsection
