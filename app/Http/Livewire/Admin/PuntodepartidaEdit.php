<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use App\Models\Puntodepartida;
use Livewire\Component;

class PuntodepartidaEdit extends Component
{

    public $puntodepartida;

    public $direccion;
    public $ubigeo;
    public $predeterminado = 0;
    public $state = 1;
    public $departments, $provinces = [], $districts = [];
    public $department_id = "", $province_id = "", $district_id = "";


    public function mount(Puntodepartida $puntodepartida)
    {
        $this->puntodepartida = $puntodepartida;

        // Cargar tipos de documento
        $this->departments = Department::select('id', 'name')->get();

        // Cargar datos del transportista
        $this->direccion = $puntodepartida->direccion;
        $this->ubigeo = $puntodepartida->ubigeo;
        $this->department_id = $puntodepartida->department_id;
        $this->province_id = $puntodepartida->province_id;
        $this->district_id = $puntodepartida->district_id;
        $this->state = $puntodepartida->state;
        $this->predeterminado = $puntodepartida->predeterminado;

        if ($this->puntodepartida->department_id) { //comprobamos que exista sino toma valor "" y en el select dira escoger o seleccionar
            $this->department_id = str_pad((string)$this->puntodepartida->department_id, 2, '0', STR_PAD_LEFT);
        }

        if ($this->puntodepartida->province_id) {
            $this->province_id = str_pad((string)$this->puntodepartida->province_id, 4, '0', STR_PAD_LEFT); //$this->puntodepartida->province_id;
        }

        if ($this->puntodepartida->district_id) {
            $this->district_id = str_pad((string)$this->puntodepartida->district_id, 6, '0', STR_PAD_LEFT); //$this->puntodepartida->district_id;
        }


        $this->departments = Department::all(); //lista todo los departamentos
        $this->provinces = Province::where('department_id', $this->department_id)->get();
        $this->districts = District::where('province_id', $this->province_id)->get();
    }


    protected $rules = [
        'direccion' => 'required|max:250',
        'ubigeo' => 'required|max:20',
        'predeterminado' => 'boolean',
        'state' => 'boolean',
        'department_id' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
    ];


    protected $messages = [
        'direccion.required' => 'El número de documento es obligatorio.',
        'direccion.250' => 'El número de documento no debe superar :max caracteres.',
        'ubigeo.required' => 'El Ubigeo es obligatoria.',
        'department_id.required' => 'El Departamento es obligatorio.',
        'province_id.required' => 'El Departamento es obligatorio.',
        'district_id.required' => 'El Departamento es obligatorio.',
    ];



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
        $this->ubigeo = $this->district_id;
    }







    public function update()
    {
        $this->validate();

        $this->puntodepartida->update([
            'direccion' => $this->direccion,
            'ubigeo' => $this->ubigeo,
            'predeterminado' => $this->predeterminado,
            'state' => $this->state,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
        ]);


        $this->emit('alert', 'El Punto de Partida se actualizó correctamente');
        return redirect()->route('puntodepartida.list');
    }






    public function render()
    {
        return view('livewire.admin.puntodepartida-edit');
    }
}
