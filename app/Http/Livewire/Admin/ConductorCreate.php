<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Tipodocumento;
use App\Models\Conductor;

class ConductorCreate extends Component
{

    public $tipodocumento_id = "";
    public $numdoc;
    public $nomape;
    public $licencia;
    public $celular;
    public $state = 1;
    public $tipodocumentos;


    public function mount()
    {
        $this->tipodocumentos = Tipodocumento::select('id', 'abbreviation')->get();
    }



    protected $rules = [
        'tipodocumento_id' => 'required|exists:tipodocumentos,id',
        'numdoc' => 'required|min:8|max:20',
        'nomape' => 'required|min:3|max:150',
        'licencia' => 'required|max:200',
        'celular' => 'required|max:20',
        'state' => 'boolean',
    ];

    protected $messages = [
        'tipodocumento_id.required' => 'Seleccione un tipo de documento.',
        'tipodocumento_id.exists' => 'El tipo de documento no es válido.',

        'numdoc.required' => 'El número de documento es obligatorio.',
        'numdoc.min' => 'El número de documento debe tener al menos :min caracteres.',
        'numdoc.max' => 'El número de documento no debe superar :max caracteres.',

        'nomape.required' => 'El nombre y apellido es obligatoria.',
        'nomape.min' => 'El nombre y apellido debe tener mínimo :min caracteres.',
        'nomape.max' => 'El nombre y apellido no debe superar :max caracteres.',

        'licencia.required' => 'La licencia es obligatoria.',
        'licencia.max' => 'La licencia no debe superar :max caracteres.',

        'celular.required' => 'El número de celular es obligatorio.',
        'celular.max' => 'El número de celular no debe superar :max caracteres.',
    ];

    public function save()
    {
        $this->validate(); // ✔ Ejecuta validaciones
        Conductor::create([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numdoc' => $this->numdoc,
            'nomape' => $this->nomape,
            'licencia' => $this->licencia,
            'celular' => $this->celular,
            'company_id' => auth()->user()->company_id,
            'state' => $this->state,
        ]);


        $this->emit('alert', 'El Conductor se creo correctamente');
        return redirect()->route('conductor.list');
    }


    public function render()
    {
        return view('livewire.admin.conductor-create');
    }
}
