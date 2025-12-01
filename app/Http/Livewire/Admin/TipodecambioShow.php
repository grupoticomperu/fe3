<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipodecambio;
use Livewire\Component;
use Carbon\Carbon;

class TipodecambioShow extends Component
{
    public $valorventa;


    public function tchoy()
    {
        $currency_id = 2;
        $company_id = auth()->user()->employee->company->id;
        $tipoDeCambio = Tipodecambio::where('currency_id', $currency_id)->where('company_id', $company_id)
            ->whereDate('fecha', Carbon::today())
            ->first();

        // Verifica si se encontró el tipo de cambio
        if ($tipoDeCambio) {
            $this->valorventa = $tipoDeCambio->valorventa; // O $tipoDeCambio->valorcompra según tus necesidades

        } else {
            $this->valorventa = null; // No se encontró un tipo de cambio para hoy
        }

       // session(['tipo_cambio' => $this->valorventa]);

    }


    public function render()
    {
        $this->tchoy(); // Llama al método tchoy
        return view('livewire.admin.tipodecambio-show');
    }
}
