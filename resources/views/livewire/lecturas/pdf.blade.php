<!DOCTYPE html>
<html lang="en">
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
    <div style="padding-top: 5px;">
        <table class="table table-bordered table-sm" with="100%">
            <thead>
                <tr>
                    <th>Salida</th>
                    <th>Entrada</th>
                    <th>% Combustible</th>
                    <th>Kilometraje</th>
                    <th>Brazo y parqueadero salida</th>
                    <th>Brazo y parqueadero entrada</th>
                    <th>Orden Movilización</th>
                    <th>Guardia entrada</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lecturas as $lec)
                <tr>
                    <td scope="row">{{ $lec->created_at }} </td>
                    <td>{{ $lec->fecha_retorno }}</td>
                    <td>{{ $lec->porcentaje_combustible }}</td>
                    <td>{{ $lec->kilometraje }}</td>
                    <td>{{ $lec->brazoSalida->codigo??'' }} {{ $lec->brazoSalida->parqueadero->nombre??'' }}</td>
                    <td>{{ $lec->brazoEntrada->codigo??'' }} {{ $lec->brazoEntrada->parqueadero->nombre??'' }}</td>
                    <td>{{ $lec->ordenMovilizacion->numero??'' }}</td>
                    <td>{{ $lec->guardia->apellidos_nombres }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</body>
</html>