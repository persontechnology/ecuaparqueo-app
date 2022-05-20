<style>
    .page-break {
        page-break-after: always;
    }
</style>
<table class="table" style="text-align: center;">
    <thead>
        <tr style="background-color:#f5f5f5">
            <th colspan="4">DATOS DE AUTORIZACIÓN</th>
        </tr>
        <tr>
            <td><strong>FECHA:</strong>{{ $dc->fecha }}</td>
            <td>
                <strong>NÚMERO DE ORDEN:</strong>{{ $dc->numero }}
            </td>
            <td><strong>CÓDIGO:</strong>{{ $dc->codigo }}</td>
            <td>
                <strong>ESTADO:</strong>{{ $dc->estado }}
            </td>
        </tr>
        <tr style="background-color:#f5f5f5">
            <th colspan="4">DATOS DE CONDUCTOR</th>
        </tr>
        <tr>
            <td scope="row" colspan="3"><strong>NOMBRE:</strong> {{ $dc->conductor->apellidos_nombres }}
            </td>
            <td><strong>CÉDULA:</strong>{{ $dc->conductor->documento }}</td>
        </tr>
        <tr style="background-color:#f5f5f5">
            <th colspan="4">DATOS DE VEHÍCULO</th>
        </tr>
        <tr>
            <td>
            <strong>PLACA: </strong>{{ $dc->vehiculo->placa }}
            </td>
            <td>
            <strong>N° MOVIL: </strong>{{ $dc->vehiculo->numero_movil }}
            </td>
            <td><strong>MARCA:</strong>{{ $dc->vehiculo->marca }}</td>
            <td><strong>COLOR:</strong>{{ $dc->vehiculo->color }}</td>
        </tr>
        <tr style="background-color:#f5f5f5">
            <th colspan="4">DETALLE</th>
        </tr>
        
    </thead>
    <tbody>
        <tr>
            <td scope="row">
                <strong>CONCEPTO</strong><br>
                <p>{{ $dc->concepto }}</p>
            </td>
            <td>
                <strong>CANTIDAD</strong><br>
                <p><strong>{{ $dc->cantidad_galones }}</strong> galones <br>{{ $dc->cantidad_letras }}</p>

            </td>
            <td colspan="2">
                <strong>VALOR</strong>
                <p><strong>$ {{ $dc->valor }}</strong> <br>{{ $dc->valor_letras }}</p>
            </td>
        </tr>
        <tr>
            <td><strong>KILOMETRAJE</strong> <br>{{ $dc->kilometraje }}</td>
            <td><strong>DESTINO</strong> <br>{{ $dc->destino }}</td>
            <td colspan="2">
                <strong>FOTO EVIDENCIA</strong>
            </td>
        </tr>
        <tr>
            <td scope="row" colspan="4"><strong>Observaciones:</strong> {{ $dc->observaciones }}</td>
        </tr>
        <tr style="background-color:#f5f5f5">
            <th colspan="4">FIRMAS</th>
        </tr>
        <tr>
            <th>Autorizado</th>
            <th>Entregué Conforme</th>
            <th colspan="2">Recibí Conforme</th>
        </tr>
        <tr>
            <td>
                <p class="text-center"><br> ______________ <br>{{ $dc->autorizado->apellidos_nombres }} <br>
                    <strong>Jefe de agencia</strong>
                </p>
            </td>
            <td>
                <p class="text-center"><br> ______________ <br>{{ $dc->despachador->apellidos_nombres??'...................' }} <br>
                    @isset($dc->estacionGasolinera->nombre)
                        <small>{{ $dc->estacionGasolinera->nombre??'' }}</small> <br>    
                    @endisset
                    
                    
                    <strong>Despachador</strong>
                </p>
            </td>
            <td colspan="2">
                <p class="text-center"><br> ______________ <br>{{ $dc->conductor->apellidos_nombres }} <br>
                    <strong>Servidor/Obrero Responsable del Vehículo</strong>
                </p>
            </td>
        </tr>
    </tbody>
</table>

@if (Storage::exists($dc->foto))
    @if ($fotoPdf==='SI')
        <style>
            #fotoEvidencia {
                background: url("{!! public_path($dc->foto_link) !!}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                height: 750px;
                
            }  
        </style> 
    @else
        <style>
            #fotoEvidencia {
                background: url("{{ $dc->foto_link }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                height: 750px;
                
            }  
        </style>   
    @endif
    <div class="page-break"></div>
    <div style="background-color:#f5f5f5;text-align: center; margin-top: 3px; border: 1px solid #000;">
        <strong>EVIDENCIA</strong>
        <p><strong>Fecha despacho: </strong>{{ $dc->fecha_despacho }}</p>
        <div id="fotoEvidencia" style="margin: 1em;"></div>
    </div>
    
    
    
@endif
