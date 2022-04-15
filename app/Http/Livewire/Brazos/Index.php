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
    public $parqueadero, $loading = false;
    public $updateModal = false;
    public $messa;
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
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function qtys($id)
    {
        $this->loading = true;
        $brazo = Brazo::findOrFail($id);
        $brazo->update([
            'estado_brazo' => !$brazo->estado_brazo,
        ]);
    }
    public function abrirModalCrear()
    {
        $this->resetInput();
        $this->emit('modalOpenStore');
    }
    public function cancelModalCrear()
    {
        $this->emit('modalCloseStore');
        $this->resetInput();
    }
    public function store()
    {
        $this->validate([
            'codigo' => 'required|unique:brazos,codigo',
            'descripcion' => 'required',
        ]);
        Brazo::create([
            'codigo' => $this->codigo,
            'estado_brazo' => false,
            'estado' => "Activo",
            'descripcion' => $this->descripcion,
            'parqueadero_id' => $this->parqueadero->id,
        ]);
        $this->updateModal = true;
        $this->emit('modalCloseStore');
        session()->flash('message', 'Brazo creado');
        $this->resetInput();
    }

    public function edit($iditarEspacio)
    {
        if ($iditarEspacio['id'] > 0) {
            $this->updateModal = true;
            $this->selected_id = $iditarEspacio['id'];
            $this->codigo = $iditarEspacio['codigo'];
            $this->estado_brazo = $iditarEspacio['estado_brazo'];
            $this->estado = $iditarEspacio['estado'];
            $this->descripcion = $iditarEspacio['descripcion'];
            $this->emit('modalOpenUpdate');
        }
    }
    public function cancelModalUpdate()
    {
        $this->emit('modalCloseUpdate');
        $this->resetInput();
    }
    public function update()
    {
        $this->validate([
            'codigo' => 'required|unique:brazos,codigo,'.$this->selected_id,
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
            $this->emit('modalCloseUpdate');
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
