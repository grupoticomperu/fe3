<?php

namespace App\Http\Livewire\Admin;

use App\Models\Local;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Department;
use App\Models\Local_tipocomprobante;
use Illuminate\Support\Facades\DB;

class LocaldEdit extends Component
{

    public $local;

    public $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $company_id, $state;
    public $tipocomprobantes;
    public $departments, $provinces = [], $districts = [];
    public $department_id = "", $province_id = "", $district_id = "";
    public $serieValues = []; // Array para almacenar los valores de serie
    public $numeroValues = []; // Array para almacenar los valores de número
    public $localTipocomprobantes;

    public function mount(Local $local)
    {
        //$this->local = $local;
        //$this->tipocomprobantes = Tipocomprobante::pluck('name', 'id');

        $this->local = $local;
        //$this->local = Local::with('local_tipocomprobantes')->findOrFail($this->local->id);
        $this->name = $this->local->name;
        $this->codigopostal = $this->local->codigopostal;
        $this->address = $this->local->address;
        $this->email = $this->local->email;
        $this->phone = $this->local->phone;
        $this->movil = $this->local->movil;
        $this->anexo = $this->local->anexo;
        $this->state = $this->local->state;



        if ($this->local->department_id) { //comprobamos que exista sino toma valor "" y en el select dira escoger o seleccionar
            $this->department_id = str_pad((string)$this->local->department_id, 2, '0', STR_PAD_LEFT);
        }

        if ($this->local->province_id) {
            $this->province_id = str_pad((string)$this->local->province_id, 4, '0', STR_PAD_LEFT); //$this->local->province_id;
        }

        if ($this->local->district_id) {
            $this->district_id = str_pad((string)$this->local->district_id, 6, '0', STR_PAD_LEFT); //$this->local->district_id;
        }


        $this->departments = Department::all(); //lista todo los departamentos
        $this->provinces = Province::where('department_id', $this->department_id)->get();
        $this->districts = District::where('province_id', $this->province_id)->get();


        // Recuperar los datos de local_tipocomprobantes para el local que se está editando
        //$localTipocomprobantes = $this->local->local_tipocomprobantes()->get();
        //$localTipocomprobantes = $this->local->local_tipocomprobantes ?? [];
        $this->localTipocomprobantes = Local_tipocomprobante::where('local_id', $this->local->id)->get();
        foreach ($this->localTipocomprobantes as $localTipocomprobante) {

            $this->serieValues[$localTipocomprobante->id] = $localTipocomprobante->serie;
            $this->numeroValues[$localTipocomprobante->id] = $localTipocomprobante->inicio;
        }

        // Obtener los IDs de los tipos de comprobantes asociados al local actual
        //$tipocomprobantesAsociados = $local->tipocomprobantes->pluck('id')->toArray();

        // Obtener los tipos de comprobantes que NO están asociados al local actual
        //$this->tipocomprobantes = Tipocomprobante::whereNotIn('id', $tipocomprobantesAsociados)->pluck('name', 'id');
    }


    public function updatedDepartmentId($value)
    {
        // Asegurar que $value sea una cadena con ceros a la izquierda
        $this->department_id = str_pad((string)$value, 2, '0', STR_PAD_LEFT);
        $this->provinces = Province::where('department_id', $this->department_id)->get();
        $this->reset(['province_id', 'district_id']);
    }



    public function updatedProvinceId($value)
    {
        $this->province_id = str_pad((string)$value, 4, '0', STR_PAD_LEFT);
        $this->districts = District::where('province_id', $this->province_id)->get();
        $this->reset('district_id');
    }

    public function updatedDistrictId($value)
    {
        $this->district_id = str_pad((string)$value, 6, '0', STR_PAD_LEFT);
        $this->codigopostal = $this->district_id;
    }



    public function update()
    {
        $this->validate([
            //'name' => 'required|unique:locals,name,' . $this->local->id, // Excepción para el registro actual
            'name' => 'required',
            'codigopostal' => 'nullable|string',
            'address' => '',
            'email' => 'required|unique:locals,email,' . $this->local->id, // Excepción para el registro actual
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'phone' => '',
            'movil' => '',
            'anexo' => '',
            'state' => ''
        ]);

        $this->local->update([
            'name' => strtoupper($this->name),
            'codigopostal' => $this->codigopostal,
            //'state' => $this->state,
            'state' => $this->state ?? $this->local->state, // Mantener el mismo valor si $this->state es nulo
            'address' => strtoupper($this->address),
            'email' => $this->email,
            'phone' => strtoupper($this->phone),
            'movil' => strtoupper($this->movil),
            'anexo' => strtoupper($this->anexo),
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'company_id' => auth()->user()->employee->company->id,
        ]);

        // Actualizar los datos de local_tipocomprobantes
        foreach ($this->serieValues as $localTipocomprobanteId => $serieValue) {

            if ($serieValue != NULL) {

                $existingSerie = DB::table('local_tipocomprobantes')
                    ->where('company_id', auth()->user()->employee->company->id)
                    ->where('serie', $serieValue)
                    ->where('id', '!=', $localTipocomprobanteId) // Excluir el registro actual
                    ->exists();

                //controla la repeticion de la serie
                if ($existingSerie) {
                    $this->emit('alert', 'La serie "' . $serieValue . '" ya existe.');
                    // No limpies los datos
                    return;
                }
            }

            $localTipocomprobante = Local_tipocomprobante::findOrFail($localTipocomprobanteId);
            $localTipocomprobante->update([
                'serie' => strtoupper($serieValue),
                'inicio' => $this->numeroValues[$localTipocomprobanteId],
            ]);
        }

        //$this->reset(['name', 'address', 'codigopostal', 'state', 'email', 'phone', 'movil', 'anexo']);

        $this->emit('alert', 'El Local se actualizó correctamente');

        //return redirect()->route('local.list');
    }




    public function render()
    {
        return view('livewire.admin.locald-edit');
    }
}
