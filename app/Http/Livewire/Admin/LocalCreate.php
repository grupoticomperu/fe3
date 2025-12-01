<?php

namespace App\Http\Livewire\Admin;

use App\Models\Local;


use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class LocalCreate extends Component
{

    use AuthorizesRequests;
    //use WithFileUploads;
    public $open = false;

    public $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $serie, $inicia, $company_id, $state;


    public function nuevo()
    {
        $this->open = true;
    }

    protected $rules = [
        'name' => 'required|unique:locals',
    ];


    public function save()
    {
        $this->authorize('create', new Local);
        $this->validate();

        //$urlimage = "/storage/brands/default.jpg";

        $statee = ($this->state) ? 1 : 0;


        Local::create([
            'name' => strtoupper($this->name),
            'codigopostal' => $this->codigopostal,
            'state' => $statee,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'movil' => $this->movil,
            'anexo' => $this->anexo,
            //'serie' => $this->serie,
            //'inicia' => $this->inicia,
            'company_id' => auth()->user()->employee->company->id,
        ]);

        $this->reset(['open', 'name']);

        $this->emitTo('admin.local-list', 'render');

        $this->emit('alert', 'El Local se creo correctamente');
    }





    public function render()
    {
        return view('livewire.admin.local-create');
    }
}
