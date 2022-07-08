<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
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
                    <td>Motivo</td>
                    <td>Fecha salida</td>
                    <td>Fecha entrada</td>
                    <td>Parqueadero & Brazo</td>
                    <td>Guardia</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($lecturasNormales as $ln)
                   <tr>
                        <td>{{ $ln->tipo }}</td>
                        <td>{{ $ln->vehiculo->numero_movil_placa }}</td>
                        <td>{{ $ln->finalizado }}</td>
                        <td>{{ $ln->motivo }}</td>
                        <td>{{ $ln->fecha_salida }}</td>
                        <td>{{ $ln->fecha_entrada }}</td>
                        <td>{{ $ln->brazo->parqueadero->nombre }}-{{ $ln->brazo->codigo }}</td>
                        <td>{{ $ln->guardia->apellidos_nombres??'' }}</td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
