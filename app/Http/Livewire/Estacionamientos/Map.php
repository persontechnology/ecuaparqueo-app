<?php

namespace App\Http\Livewire\Estacionamientos;

use Livewire\Component;

class Map extends Component
{
    public $numero;
    public function render()
    {
        return view('livewire.estacionamientos.map');
    }
}
