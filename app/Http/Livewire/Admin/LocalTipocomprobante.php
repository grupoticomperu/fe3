<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LocalTipocomprobante extends Component
{

    public $local;


    protected $listeners = ['render'];


    public function mount($local)
    {
        $this->local = $local;
    }


    public function render()
    {

        return view('livewire.admin.local-tipocomprobante');
    }

    public function deletipocomprobante($tipocomprobanteId)
    {
        $this->emit('deleteTipocomprobante', $tipocomprobanteId);
    }
}
