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
        <table>
            <tbody>
                <tr>
                    <td>N° orden</td>
                    <td>N° movil placa</td>
                    <td>N° ocupantes</td>
                    <td>Lugar de destino</td>
                    <td>Motivio de la comisión</td>
                    <td>Fecha y hora de salida</td>
                    <td>Fecha y hora de retorno</td>
                    <td>Conductor</td>
                    <td>Responsable de autorización</td>
                    <td>Cargo del responsable de autorización</td>
                </tr>
                @foreach ($ordenes as $orden)
                <tr>
                    <td>{{ $orden->numero }}</td>
                    <td>{{ $orden->vehiculo->numero_movil_placa??'' }}</td>
                    <td>{{ $orden->numero_ocupantes }}</td>
                    <td>{{ $orden->destino }}</td>
                    <td>{{ $orden->comision_cumplir }}</td>
                    <td>{{ $orden->fecha_salida }}</td>
                    <td>{{ $orden->fecha_retorno }}</td>
                    <td>{{ $orden->conductor->apellidos_nombres??'' }}</td>
                    <td>{{ $orden->autorizado->apellidos_nombres??'' }}</td>
                    <td>{{ $orden->autorizado->descripcion??'' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</body>
</html>