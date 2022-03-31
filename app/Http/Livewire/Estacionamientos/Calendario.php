<?php

namespace App\Http\Livewire\Estacionamientos;

use App\Models\OrdenMovilizacion;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Calendario extends Component
{
    public $vehiculo, $count = 0;
    public $Ordenes,  $startDate, $endDate, $estadoOrdenes, $loanding = false;
    public function mount(Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;
    }
    public function render()
    {
        $this->loanding = true;
        $reservas = OrdenMovilizacion::where(['vehiculo_id' => $this->vehiculo->id])
            ->whereDate("fecha_salida", ">=", $this->startDate ?? Carbon::now()->startOfMonth())
            ->whereDate("fecha_retorno", "<", $this->endDate ?? Carbon::now()->endOfMonth())
            ->get()
            ->map(function (Model $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->numero,
                    'start' => $model->fecha_salida,
                    'end' => $model->fecha_retorno,
                    'color' => '#66a69a',
                    'backgroundColor' => '#66a69a'
                ];
            });

        $this->Ordenes = json_encode($reservas);
        $this->loanding = false;
        return view('livewire.estacionamientos.calendario');
    }
    public function actualizarDate($dateStart, $dateEnd)
    {
        $this->loanding = true;
        $this->Ordenes = null;
        $this->startDate = $dateStart;
        $this->endDate = $dateEnd;
        if ($this->startDate) {
            $reservas = OrdenMovilizacion::where(['vehiculo_id' => $this->vehiculo->id])
                ->whereDate("fecha_salida", ">=", $this->startDate ?? Carbon::now()->startOfMonth())
                ->whereDate("fecha_retorno", "<=", $this->endDate ?? Carbon::now()->endOfMonth())
                ->get()
                ->map(function (Model $model) {
                    return [
                        'id' => $model->id,
                        'title' => $model->numero,
                        'start' => $model->fecha_salida,
                        'end' => $model->fecha_retorno,
                        'color' => '#66a69a',
                        'backgroundColor' => '#66a69a'
                    ];
                });
            return json_encode($reservas);
        }
        $this->loanding = false;
    }
}
