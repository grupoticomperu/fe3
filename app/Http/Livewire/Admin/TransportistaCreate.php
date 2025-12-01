<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipodocumento;
use App\Models\Transportista;
use Livewire\Component;

class TransportistaCreate extends Component
{

    public $tipodocumento_id = "";
    public $numdoc;
    public $nomrazonsocial;
    public $address;
    public $nromtc;
    public $predeterminado = 0;
    public $state = 1;
    public $tipodocumentos;


    public function mount()
    {
        $this->tipodocumentos = Tipodocumento::select('id', 'abbreviation')->get();
    }



    protected $rules = [
        'tipodocumento_id' => 'required|exists:tipodocumentos,id',
        'numdoc' => 'required|min:8|max:20',
        'nomrazonsocial' => 'required|min:3|max:150',
        'address' => 'required|max:200',
        'nromtc' => 'required|max:20',
        'predeterminado' => 'boolean',
        'state' => 'boolean',
    ];

    protected $messages = [
        'tipodocumento_id.required' => 'Seleccione un tipo de documento.',
        'tipodocumento_id.exists' => 'El tipo de documento no es válido.',

        'numdoc.required' => 'El número de documento es obligatorio.',
        'numdoc.min' => 'El número de documento debe tener al menos :min caracteres.',
        'numdoc.max' => 'El número de documento no debe superar :max caracteres.',

        'nomrazonsocial.required' => 'La razón social es obligatoria.',
        'nomrazonsocial.min' => 'La razón social debe tener mínimo :min caracteres.',
        'nomrazonsocial.max' => 'La razón social no debe superar :max caracteres.',

        'address.required' => 'La dirección es obligatoria.',
        'address.max' => 'La dirección no debe superar :max caracteres.',

        'nromtc.required' => 'El número MTC es obligatorio.',
        'nromtc.max' => 'El número MTC no debe superar :max caracteres.',
    ];




    public function save()
    {

        $this->validate(); // ✔ Ejecuta validaciones

        Transportista::create([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numdoc' => $this->numdoc,
            'nomrazonsocial' => $this->nomrazonsocial,
            'address' => $this->address,
            'nromtc' => $this->nromtc,
            'company_id' => auth()->user()->company_id,
            'predeterminado' => $this->predeterminado,
            'state' => $this->state,
        ]);


        $this->emit('alert', 'El Transportista se creo correctamente');
        return redirect()->route('transportista.list');
    }



    public function render()
    {
        return view('livewire.admin.transportista-create');
    }
}
