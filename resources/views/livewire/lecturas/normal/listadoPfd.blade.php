<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            font-family: Tahoma, Geneva, sans-serif;
        }

        table td {
            padding: 2px;
        }

        table thead td {
            background-color: #54585d;
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
            border: 1px solid #fff;
        }

        table tbody td {
            color: #636363;
            border: 1px solid #dddfe1;
        }

        table tbody tr {
            background-color: #f9fafb;
        }

        table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div style="padding-top: 5px;">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <td>Tipo</td>
                    <td>N° Vehículo & Placa</td>
                    <td>Finalizado</td>
                    <td>Porcentaje combustible</td>
                    <td>kilometraje</td>
                    <td>Observación</td>
                    <td>Proceso orden movilización</td>
                    <td>Fecha salida</td>
                    <td>Fecha entrada</td>
                    <td>Parqueadero & Brazo</td>
                    <td>Guardia</td>
                    <td>Orden movilizacion</td>
                    <td>Chofer</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($lecturasNormales as $ln)
                    <tr>
                        <td>{{ $ln->tipo }}</td>
                        <td>{{ $ln->vehiculo->numero_movil_placa }}</td>
                        <td>{{ $ln->finalizado }}</td>
                        <td>{{ $ln->porcentaje_combustible }}</td>
                        <td>{{ $ln->kilometraje }}</td>
                        <td>{{ $ln->observacion }}</td>
                        <td>{{ $ln->proceso_orden_movilizacion }}</td>
                        <td>{{ $ln->fecha_salida }}</td>
                        <td>{{ $ln->fecha_entrada }}</td>
                        <td>{{ $ln->brazo->parqueadero->nombre }}-{{ $ln->brazo->codigo }}</td>
                        <td>{{ $ln->guardia->apellidos_nombres ?? '' }}</td>
                        <td>{{ $ln->ordenMovilizacion->numero ?? '' }}</td>
                        <td>{{ $ln->chofer->apellidos_nombres ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
