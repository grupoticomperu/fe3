<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipodocumento;
use App\Models\Vehiculo;
use Livewire\Component;

class VehiculoEdit extends Component
{

    public $tipodocumento_id = "";
    public $numeroplaca;
    public $modelo;
    public $marca;
    public $tuce;
    public $predeterminado = 0;
    public $state = 1;
    public $tipodocumentos;
    public $vehiculo;


    public function mount(Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;

        // Cargar tipos de documento
        $this->tipodocumentos = Tipodocumento::select('id', 'abbreviation')->get();

        // Cargar datos del transportista
        $this->tipodocumento_id = $vehiculo->tipodocumento_id;
        $this->numeroplaca = $vehiculo->numeroplaca;
        $this->modelo = $vehiculo->modelo;
        $this->marca = $vehiculo->marca;
        $this->tuce = $vehiculo->tuce;
        $this->predeterminado = $vehiculo->predeterminado;
        $this->state = $vehiculo->state;
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

    public function update()
    {
        $this->validate();

        $this->vehiculo->update([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numeroplaca' => $this->numeroplaca,
            'modelo' => $this->modelo,
            'marca' => $this->marca,
            'tuce' => $this->tuce,
            'predeterminado' => $this->predeterminado,
            'state' => $this->state,
        ]);

        $this->emit('alert', 'El Vehículo se actualizó correctamente');
        return redirect()->route('vehiculo.list');
    }



    public function render()
    {
        return view('livewire.admin.vehiculo-edit');
    }
}
