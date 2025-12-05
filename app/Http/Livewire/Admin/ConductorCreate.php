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



    /*     protected $rules = [
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
    ]; */



    protected function rules()
    {
        return [
            'tipodocumento_id' => 'required|exists:tipodocumentos,id',

            // VALIDACIÓN DINÁMICA + UNIQUE
            'numdoc' => [
                'required',
                $this->tipodocumento_id == 2      // DNI
                    ? 'digits:8'
                    : ($this->tipodocumento_id == 4 // RUC
                        ? 'digits:11'
                        : 'min:8|max:20'),
                'unique:conductors,numdoc',
            ],

            'nomape' => 'required|min:3|max:150',

            // VALIDACIÓN DE LICENCIA DE CONDUCIR PARA GUÍA ELECTRÓNICA
            // FORMATO: 8 dígitos + categoría válida (A1, A2A, A2B, A2C, A3A, A3B, A3C, B1, B2A, B2B, B2C)
            'licencia' => [
                'required',
                'regex:/^[0-9]{8}(A1|A2A|A2B|A2C|A3A|A3B|A3C|B1|B2A|B2B|B2C)$/'
            ],

            'celular' => 'required|max:20',
            'state' => 'boolean',
        ];
    }

    protected $messages = [
        'tipodocumento_id.required' => 'Seleccione un tipo de documento.',
        'tipodocumento_id.exists' => 'El tipo de documento no es válido.',

        'numdoc.required' => 'El número de documento es obligatorio.',
        'numdoc.digits' => 'El número de documento debe tener exactamente :digits dígitos.',
        'numdoc.min' => 'El número de documento debe tener mínimo :min caracteres.',
        'numdoc.max' => 'El número de documento no debe superar :max caracteres.',

        'nomape.required' => 'El nombre y apellido es obligatorio.',
        'nomape.min' => 'Debe tener mínimo :min caracteres.',
        'nomape.max' => 'No debe superar :max caracteres.',

        'licencia.required' => 'La licencia es obligatoria.',
        'licencia.regex' => 'La licencia debe tener formato válido: 8 dígitos seguidos de categoría (Ej: 12345678A1, 12345678A2B).',

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
