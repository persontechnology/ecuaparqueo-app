<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table , td, th {
            width: 100%;
            border: 1px solid #595959;
            border-collapse: collapse;
            text-align: center;
        }
        td, th {
            padding: 2px;
            width: 30px;
            height: 25px;
        }
        
    </style>

</head>
<body>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th># Espacio</th>
                            <th>Vehículo <small># móvil placa</small></th>
                            <th>Conductor</th>
                            <th>Tipo Vehículo</th>
                            <th>Estado</th>
            
                        </tr>
                    </thead>
                    @if ($parqueadero->espacios->count()>0)
                        <tbody>
                            

                            @foreach ($parqueadero->espacios as $esp)
                            <tr>
                                
                                <td scope="row">{{ $esp->numero }}</td>
                                <td class="text-center">
                                    {{ $esp->vehiculo->numero_movil_placa??'N/A' }}
                                </td>
                                <td>
                                    {{ $esp->vehiculo->info_conductor??'' }}
                                </td>
                                <td>
                                    {{ $esp->vehiculo->tipoVehiculo->nombre??'' }}
                                </td>
                                <td>
                                    <span class="badge badge-{{ $esp->color_estado }}">{{ $esp->estado}}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    @endif

                </table>
            </div>
        </div>
    </div>



</body>
</html>