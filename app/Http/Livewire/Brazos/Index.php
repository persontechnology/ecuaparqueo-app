<?php

namespace App\Http\Livewire\Brazos;

use App\Models\Brazo;
use App\Models\Parqueadero;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $data1, $codigo, $estado_brazo, $estado, $descripcion, $selected_id;
    public $parqueadero,$loading=false;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';
    protected $initializeWithPagination;
    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '']
    ];
    public $search;
    public $perPage;
    public function mount(Parqueadero $parqueadero)
    {
        $this->parqueadero = $parqueadero;
    }
    public function render()
    {
        $brazos = Brazo::where('codigo', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage ?? 25);
        return view('livewire.brazos.index', ['brazos' => $brazos]);
    }

    private function resetInput()
    {
        $this->codigo = null;
        $this->estado_brazo = null;
        $this->estado = null;
        $this->descripcion = null;
    }
    public function qtys($id)
    {
        $this->loading=true;
        $brazo = Brazo::findOrFail($id);      
        $brazo->update([
            'estado_brazo' => !$brazo->estado_brazo,
        ]);
       
    }
    public function store()
    {
        $this->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
        ]);
        Brazo::create([
            'codigo' => $this->codigo,
            'estado_brazo' => false,
            'estado' => "Activo",
            'descripcion' => $this->descripcion,
            'parqueadero_id' => $this->parqueadero->id,
        ]);
        $this->resetInput();
        request()->session()->flash('success', 'Brazo creado');
        $this->dispatchBrowserEvent('brazoStore');
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInput();
    }
    public function edit($id)
    {
        $brazo = Brazo::findOrFail($id);
        $this->selected_id=$brazo->id;
        $this->codigo = $brazo->codigo;
        $this->estado_brazo = $brazo->estado_brazo;
        $this->estado = $brazo->estado;
        $this->descripcion = $brazo->descripcion;
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
        ]);
        if ($this->selected_id) {
            $brazo = Brazo::find($this->selected_id);
            $brazo->update([
                'codigo' => $this->codigo,
                'estado' => $this->estado,
                'descripcion' => $this->descripcion,
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $brazo = Brazo::where('id', $id);
            $brazo->delete();
        }
    }
}