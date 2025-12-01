<?php

namespace App\Http\Livewire\Admin;

use App\Models\Local;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Department;
use App\Models\Local_tipocomprobante;
use App\Models\Tipocomprobante;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class LocalCreated extends Component
{
    use AuthorizesRequests;

    public $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $company_id, $state;
    public $tipocomprobantes, $cart;
    public $departments, $provinces = [], $districts = [];
    public $department_id = "", $province_id = "", $district_id = "";
    public $serieValues = []; // Array para almacenar los valores de serie
    public $numeroValues = []; // Array para almacenar los valores de número
    protected $errorMessage = '';

    public function mount()
    {
        $this->tipocomprobantes = Tipocomprobante::all();
        $this->departments = Department::all(); //lista todo los departamentos
        //$this->provinces = Province::where('department_id', $this->department_id)->get();
        //$this->districts = District::where('province_id', $this->province_id)->get();
    }


    //cuando escoges el departamento
    public function updatedDepartmentId($value)
    {
        // Asegurar que $value sea una cadena con ceros a la izquierda
        $this->department_id = str_pad((string)$value, 2, '0', STR_PAD_LEFT);
        $this->provinces = Province::where('department_id', $this->department_id)->get();
        $this->reset(['province_id', 'district_id']);
    }


    //cuando escoges la provincia
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


    protected $rules = [
        'name' => 'required|unique:locals',
        'codigopostal' => '',
        'address' => '',
        'email' => 'required|unique:locals',
        'department_id' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
        'phone' => '',
        'movil' => '',
        'anexo' => '',
        'state' => ''
    ];




    public function save()
    {
        $this->authorize('create', new Local);
        $this->validate();

        // Comenzar la transacción
        DB::beginTransaction();

        try {
            $statee = ($this->state) ? 1 : 0;//si seleccionas el state es 1

            // Crear el local
            $local = Local::create([
                'name' => strtoupper($this->name),
                'codigopostal' => $this->codigopostal,
                'state' => $statee,
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

            // Crear los local_tipocomprobantes dentro de la transacción
            foreach ($this->tipocomprobantes as $index => $tipocomprobante) {
                //$serie = $this->serieValues[$index] ?? null;
                $serie = strtoupper($this->serieValues[$index] ?? null);
                $numero = $this->numeroValues[$index] ?? null;

                if ($serie != NULL) {//para controlar si la serie ingresada es nulo
                    // Verificar si la serie ya existe para la empresa actual
                    $existingSerie = DB::table('local_tipocomprobantes')
                        ->where('company_id', auth()->user()->employee->company->id)
                        ->where('serie', $serie)
                        ->exists();

                    //controla la repeticion de la serie
                    if ($existingSerie) {
                        $this->emit('alert', 'La serie "' . $serie . '" ya existe.');
                        // No limpies los datos
                        return;
                    }

                    // Si la serie ya existe para la empresa actual, manejar el error
                    if ($existingSerie) {
                        // Rollback: revertir las operaciones de la transacción
                        DB::rollback();

                        // Emitir un mensaje de error
                        $this->emit('error', 'La serie ' . $serie . ' ya existe para esta empresa.');

                        // Redireccionar de nuevo al formulario de creación
                        return redirect()->route('local.create');
                    }
                }



                Local_tipocomprobante::create([
                    'local_id' => $local->id,
                    'tipocomprobante_id' => $tipocomprobante->id,
                    'serie' => $serie,
                    'inicio' => $numero,
                    'company_id' => auth()->user()->employee->company->id,
                ]);
            }

            // Commit: confirmar las operaciones de la transacción
            DB::commit();

            $this->reset(['name', 'codigopostal', 'state', 'email', 'phone', 'movil', 'anexo']);

            $this->emit('alert', 'El Local se creó correctamente');

            // Redireccionar a la ruta '/locales'
            return redirect()->route('local.list');
        } catch (\Exception $e) {
            // Rollback: revertir las operaciones de la transacción si hay un error
            DB::rollback();

            // Registrar el error
            \Log::error('Error al crear local: ' . $e->getMessage());

            // Emitir un mensaje de error
            $this->emit('error', 'Se produjo un error al crear el Local. Inténtalo de nuevo.');

            // Redireccionar de nuevo al formulario de creación
            return redirect()->route('local.create');
        }
    }






    public function cancel()
    {
        // Redirecciona a la ruta '/locales'
        return redirect()->route('local.list');
    }



    public function render()
    {
        return view('livewire.admin.local-created');
    }
}
