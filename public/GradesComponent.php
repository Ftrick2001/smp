<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grade;

class GradesComponent extends Component
{

    use WithPagination;

    public $grados;
    public $grade;
    public $gradoId;

    protected $rules = [
        'grade' => 'required|integer|min:1|max:6',
    ];


    public function save()
    {
        $this->validate();

        Grade::create([
            'grade' => $this->grade,
        ]);

        $this->resetInput();
        $this->grados = Grade::all();
    }

    public function edit($id)
    {
        $grado = Grade::find($id);
        $this->gradoId = $grado->id;
        $this->grade = $grado->grade;
    }

    public function update()
    {
        $this->validate();

        if ($this->gradoId) {
            $gradoId = intval($this->gradoId); // Asegúrate de que el ID sea un entero
            $grado = Grade::find($gradoId);

            if ($grado) {
                $grado->update(['grade' => $this->grade]);
                $this->resetInput();
                $this->emit('gradoActualizado'); // Emite un evento para actualizar la tabla
            } else {
                // Mostrar un mensaje de error indicando que el grado no existe
            }
        }
    }

    public function delete($id)
    {
        Grade::find($id)->delete();
        $this->grados = Grade::all();
    }

    private function resetInput()
    {
        $this->grade = null;
        $this->gradoId = null;
    }

    public function render()
    {
        // Recuperar grados paginados y ordenados por fecha de creación
        $grados = Grade::latest()->paginate(10);

        // Verificar que $grados sea iterable antes de pasarlo a la vista
        return view('livewire.grades-component', [
            'grados' => $grados ?? collect() // Devuelve una colección vacía si $grados es null
        ]);
    }
}
