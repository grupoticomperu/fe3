<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipodocumento;
use App\Models\Vehiculo;
use Livewire\Component;

class VehiculoCreate extends Component
{

    public $tipodocumento_id = "";
    public $numeroplaca;
    public $modelo;
    public $marca;
    public $tuce;
    public $predeterminado = 0;
    public $state = 1;
    public $tipodocumentos;


    public function mount()
    {
        $this->tipodocumentos = Tipodocumento::select('id', 'abbreviation')->get();
    }


    protected $rules = [
       
        'numeroplaca' => 'required|min:6|max:6',
        'modelo' => 'required|min:3|max:150',
        'marca' => 'required|max:200',
        'tuce' => 'required|max:20',
        'predeterminado' => 'boolean',
        'state' => 'boolean',
    ];

    protected $messages = [
       
        'numeroplaca.required' => 'El número de documento es obligatorio.',
        'numeroplaca.min' => 'El número de documento debe tener al menos :min caracteres.',
        'numeroplaca.max' => 'El número de documento no debe superar :max caracteres.',

        'modelo.required' => 'El Modelo es obligatoria.',
        'modelo.min' => 'El Modelo debe tener mínimo :min caracteres.',
        'modelo.max' => 'El Modelo no debe superar :max caracteres.',

        'marca.required' => 'La dirección es obligatoria.',
        'marca.max' => 'La dirección no debe superar :max caracteres.',

        'tuce.required' => 'El tuce es obligatorio.',
        'tuce.max' => 'El tuce no debe superar :max caracteres.',
    ];

    public function save()
    {

        $this->validate(); // ✔ Ejecuta validaciones

        Vehiculo::create([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numeroplaca' => $this->numeroplaca,
            'modelo' => $this->modelo,
            'marca' => $this->marca,
            'tuce' => $this->tuce,
            'company_id' => auth()->user()->company_id,
            'predeterminado' => $this->predeterminado,
            'state' => $this->state,
        ]);


        $this->emit('alert', 'El Vehículo se creo correctamente');
        return redirect()->route('vehiculo.list');
    }


    public function render()
    {
        return view('livewire.admin.vehiculo-create');
    }
}
