<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipodocumento;
use App\Models\Vehiculo;
use Livewire\Component;
use Illuminate\Validation\Rule;

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


    // 👇 REGLAS DINÁMICAS PARA EDITAR (ignora el propio ID)
    protected function rules()
    {
        return [
            'numeroplaca' => [
                'required',
                'min:6',
                'max:6',
                Rule::unique('vehiculos', 'numeroplaca')->ignore($this->vehiculo->id),
            ],
            'modelo' => ['required', 'min:3', 'max:150'],
            'marca' => ['required', 'max:200'],
            'tuce' => ['required', 'max:20'],
            'predeterminado' => ['boolean'],
            'state' => ['boolean'],
        ];
    }

    protected $messages = [
        'numeroplaca.required' => 'El número de placa es obligatorio.',
        'numeroplaca.min' => 'El número de placa debe tener al menos :min caracteres.',
        'numeroplaca.max' => 'El número de placa no debe superar :max caracteres.',
        'numeroplaca.unique' => 'Esta placa ya se encuentra registrada.',

        'modelo.required' => 'El Modelo es obligatorio.',
        'modelo.min' => 'El Modelo debe tener mínimo :min caracteres.',
        'modelo.max' => 'El Modelo no debe superar :max caracteres.',

        'marca.required' => 'La marca es obligatoria.',
        'marca.max' => 'La marca no debe superar :max caracteres.',

        'tuce.required' => 'El TUCE es obligatorio.',
        'tuce.max' => 'El TUCE no debe superar :max caracteres.',
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
