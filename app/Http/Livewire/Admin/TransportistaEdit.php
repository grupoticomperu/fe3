<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Tipodocumento;
use App\Models\Transportista;

class TransportistaEdit extends Component
{

    public $transportista;

    public $tipodocumento_id = "";
    public $numdoc;
    public $nomrazonsocial;
    public $address;
    public $nromtc;
    public $predeterminado;
    public $state;
    public $tipodocumentos;



    public function mount(Transportista $transportista)
    {
        $this->transportista = $transportista;

        // Cargar tipos de documento
        $this->tipodocumentos = Tipodocumento::select('id', 'abbreviation')->get();

        // Cargar datos del transportista
        $this->tipodocumento_id = $transportista->tipodocumento_id;
        $this->numdoc = $transportista->numdoc;
        $this->nomrazonsocial = $transportista->nomrazonsocial;
        $this->address = $transportista->address;
        $this->nromtc = $transportista->nromtc;
        $this->predeterminado = $transportista->predeterminado;
        $this->state = $transportista->state;
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

    public function update()
    {
        $this->validate();

        $this->transportista->update([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numdoc' => $this->numdoc,
            'nomrazonsocial' => $this->nomrazonsocial,
            'address' => $this->address,
            'nromtc' => $this->nromtc,
            'predeterminado' => $this->predeterminado,
            'state' => $this->state,
        ]);

        $this->emit('alert', 'El Transportista se actualizó correctamente');
        return redirect()->route('transportista.list');
    }


    public function render()
    {
        return view('livewire.admin.transportista-edit');
    }
}
