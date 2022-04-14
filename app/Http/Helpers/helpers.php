<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;

if (!function_exists('rangoFechas')) {
    function rangoFechas($rango = "MESESACTUAL")
    {
        $arrayFechas = [];
        if ($rango === "DIA") {

            for ($i = 0; $i < 24; $i++) {
                $fechaActual = Carbon::now()->startOfDay();
                $arrayFechas[$i] = $fechaActual->addHours($i)->toDateTimeString();
            }
            $arrayFechas[sizeof($arrayFechas)] = Carbon::parse($arrayFechas[sizeof($arrayFechas) - 1])->addMinutes(59)->toDateTimeString();
        } else   if ($rango === "SEMANA") {

            for ($i = 0; $i < 7; $i++) {
                $fechaActual = Carbon::now();
                $arrayFechas[$i] = $fechaActual->startOfWeek()->addDay($i)->toDateTimeString();
            }
        } else   if ($rango === "MESACTUAL") {

            for ($i = 0; $i < Carbon::now()->endOfMonth()->day; $i++) {
                $fechaActual = Carbon::now();
                $arrayFechas[$i] = $fechaActual->startOfMonth()->addDay($i)->toDateTimeString();
            }
        } else   if ($rango === "MESANTERIOR") {

            for ($i = 0; $i < Carbon::now()->endOfMonth()->day; $i++) {
                $fechaActual = Carbon::now();
                $arrayFechas[$i] = $fechaActual->startOfMonth()->addDay($i)->toDateTimeString();
            }
        } else  if ($rango === "ANIO") {

            for ($i = 0; $i < 12; $i++) {
                $fechaActual = Carbon::now();
                $arrayFechas[$i] = $fechaActual->startOfYear()->addMonth($i)->toDateTimeString();
            }
        } else   if ($rango === "MESESACTUAL") {

            for ($i = 0; $i < Carbon::now()->month; $i++) {
                $fechaActual = Carbon::now();
                $arrayFechas[$i] = $fechaActual->startOfYear()->addMonth($i)->toDateTimeString();
            }
        }
        return ($arrayFechas);
    }
}
