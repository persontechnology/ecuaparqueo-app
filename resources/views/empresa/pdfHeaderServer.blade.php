<!DOCTYPE html>
@php
    $empresa=App\Models\Empresa::first();
    $logo=Storage::exists($empresa->logo)?Storage::url($empresa->logo):''
@endphp

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    @if ($empresa->logo_link)
        <style>
            #example1 {
                background: url("{{ $empresa->logo_link }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                
            }  
        </style>
    @endif
    <style>
         table, td, th {
                border: 1px solid;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            } 
    </style>
        
</head>
<body>
    
    <table class="table">
        <tbody>
            <tr>
                <td rowspan="4" id="example1" style="width: 20%">
                </td>
                <th class="col-6 py-0 text-center" rowspan="4" style="width: 60%">
                    <p>{{ $titulo??'FORMULARIO ORDEN DE MOVILIZACIÓN DENTRO DEL ÁREA DE CONSECIÓN' }}</p>
                </th>
                <th >CÓDIGO </th>
                <td >{{ $empresa->codigo }}</td>
            </tr>
            <tr>
                <th >VERSIÓN</th>
                <td >{{ $empresa->version }}</td>
            </tr>
            <tr>
                <th >FECHA</th>
                <td >{{ \Carbon\Carbon::now() }}</td>
            </tr>
            <tr>
                <th >NORMA</th>
                <td >{{ $empresa->norma }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>