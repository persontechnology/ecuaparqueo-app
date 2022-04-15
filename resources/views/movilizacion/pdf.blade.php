<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
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
<body>
    <div style="padding-top: 5px;">
        <table>
            <tbody>
                <tr>
                    <th>NÚMERO DE ORDEN</th>
                    <td colspan="7">{{ $orden->numero }}</td>
                </tr>
                <tr>
                    <th>Fecha de solicitud:</th>
                    <td>{{ $orden->created_at }}</td>
                    <th>Fecha y hora de salida</th>
                    <td>{{ $orden->fecha_salida }}</td>
                    <th>Fecha y hora de retorno</th>
                    <td>{{ $orden->fecha_retorno }}</td>
                    <th>N° ocupantes</th>
                    <td>{{ $orden->numero_ocupantes }}</td>
                </tr>
                <tr>
                    <th>N° Movil</th>
                    <td>{{ $orden->vehiculo->numero_movil }}</td>
                    <th>Marca</th>
                    <td>{{ $orden->vehiculo->marca }}</td>
                    <th>Modelo</th>
                    <td colspan="3">{{ $orden->vehiculo->modelo }}</td>
                </tr>
                <tr>
                    <th>Placa</th>
                    <td>{{ $orden->vehiculo->placa }}</td>
                    <th>Tipo</th>
                    <td>{{ $orden->vehiculo->tipoVehiculo->nombre }}</td>
                    <th>Color</th>
                    <td colspan="3">{{ $orden->vehiculo->color }}</td>
                </tr>
                <tr>
                    <th>Procedencia</th>
                    <td colspan="3">{{ $orden->procedencia }}</td>
                    
                    <th>Destino</th>
                    <td colspan="3">{{ $orden->destino }}</td>
                </tr>
                <tr>
                    <th>Comisión a cumplir</th>
                    <td colspan="7">{{ $orden->comision_cumplir }}</td>
                </tr>
                <tr>
                    <th>Datos del conductor</th>
                    <td colspan="3">{{ $orden->conductor->apellidos_nombres??'' }}</td>
                    <th>Cargo</th>
                    <td colspan="3">{{ $orden->conductor->descripcion??'' }}</td>
                </tr>
                <tr>
                    <th>Datos del solicitante</th>
                    <td colspan="3">{{ $orden->solicitante->apellidos_nombres??'' }}</td>
                    <th>Cargo</th>
                    <td colspan="3">{{ $orden->solicitante->descripcion??'' }}</td>
                </tr>
                <tr>
                    <th>Autorizado por</th>
                    <td colspan="7">
                        <p>
                            {{ $orden->autorizado->apellidos_nombres??'' }}
                            <br>
                            <strong>{{ $orden->autorizado->descripcion??'' }}</strong>
                        </p>
                        
                    </td>
                </tr>
            </tbody>
        </table>
</div>
</body>
</html>