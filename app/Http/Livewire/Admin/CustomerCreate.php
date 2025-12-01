<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Models\Tipodocumento;

use Illuminate\Support\Facades\Http;

class CustomerCreate extends Component
{

    public $tipodocumento_id = "";
    public $ruc, $razon_social, $nombre_comercial, $direccion = "";
    public $departamento, $provincia, $distrito, $department_id = null, $province_id = null, $district_id = null;
    public $tipocomprobante_id;
    public $isDocumentTypeSelected = false;
    public $company, $company_id;
    public $departments, $provinces, $districts;
    public $phone, $movil, $whatsapp, $contact;
    public $email, $email2, $email3, $email4;
    public $state;
    public $local_id;


    public function mount()
    {
        $this->company = auth()->user()->employee->company;
        $this->company_id = auth()->user()->employee->company->id; //compañia logueaada
        $this->local_id = auth()->user()->employee->local->id;//no hay relacion local con customer
        //$this->departments = Department::all();
        //$this->provinces = Province::all();
        if ($this->department_id) { //comprobamos que exista sino toma valor null y en el select dira escoger o seleccionar
            $this->department_id = str_pad((string)$this->department_id, 2, '0', STR_PAD_LEFT); //por ejeplo si es 1 le agrega 0 para que sea 01
        }
        if ($this->province_id) {
            $this->province_id = str_pad((string)$this->province_id, 4, '0', STR_PAD_LEFT); //$this->province_id;
        }
        if ($this->district_id) {
            $this->district_id = str_pad((string)$this->district_id, 6, '0', STR_PAD_LEFT); //$this->district_id;  estaba 2 le puse 6
        }

        $this->departments = Department::all(); //lista todo los departamentos
        $this->provinces = [];
        $this->districts = [];
    }



    public function updatedTipodocumentoId($value)
    {
        //si es RUC debe seleccionar factura en tipocomprobante osea tipocomprobante_id = 1
        //tipodocumento su id = 4  tipodocumento su codigo = 6
        if ($this->tipodocumento_id == 4) {
            $this->tipocomprobante_id = 1;
            $this->updatedTipocomprobanteId(1);
        } else {
            $this->tipocomprobante_id = 2;
            $this->updatedTipocomprobanteId(2);
        }

        $this->isDocumentTypeSelected = !empty($value);
        $this->ruc = "";
        $this->razon_social = "";
        $this->nombre_comercial = "";
        $this->direccion = "";
        $this->departamento = "";
        $this->provincia = "";
        $this->distrito = "";
    }



    public function searchRuc()
    {
        $tipodocumento = Tipodocumento::find($this->tipodocumento_id);
        $length = Str::length($this->ruc);

        // 🧾 Validaciones de longitud
        if ($tipodocumento->codigo === '6' && $length != 11) {
            $this->emit('alert', 'El RUC debe tener 11 dígitos');
            return;
        }
        if ($tipodocumento->codigo === '1' && $length != 8) {
            $this->emit('alert', 'El DNI debe tener 8 dígitos');
            return;
        }

        // 🔍 Buscar en base local primero
        $customer = Customer::where('numdoc', $this->ruc)->first();
        if ($customer) {
            $this->razon_social = $customer->nomrazonsocial;
            $this->nombre_comercial = $customer->nombrecomercial;
            $this->direccion = $customer->address;
            $this->departamento = optional($customer->department)->name;
            $this->provincia = optional($customer->province)->name;
            $this->distrito = optional($customer->district)->name;
            return;
        }

        // 🌐 Consultar API externa
        $token = config('services.consulta_ruc.token');
        $base = rtrim(config('services.consulta_ruc.base_url'), '/');

        // ENDPOINTS CORRECTOS para APIs.net.pe
        $endpoint = $tipodocumento->codigo === '6'
            ? "{$base}/ruc?numero={$this->ruc}"
            : "{$base}/dni?numero={$this->ruc}";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->timeout(10)->get($endpoint);

            if (!$response->successful()) {
                $this->emit('alert', 'Error al consultar APIs.net.pe (' . $response->status() . ')');
                return;
            }

            $data = $response->json();

            if ($tipodocumento->codigo === '6') {
                // 🧾 Respuesta tipo RUC
                $this->razon_social = $data['nombre'] ?? '';
                $this->nombre_comercial = $data['nombreComercial'] ?? '';
                $this->direccion = $data['direccion'] ?? '';
                $this->departamento = $data['departamento'] ?? '';
                $this->provincia = $data['provincia'] ?? '';
                $this->distrito = $data['distrito'] ?? '';
            } elseif ($tipodocumento->codigo === '1') {
                // 🪪 Respuesta tipo DNI
                $nombres = $data['nombres'] ?? '';
                $apellidoPaterno = $data['apellidoPaterno'] ?? '';
                $apellidoMaterno = $data['apellidoMaterno'] ?? '';

                $this->razon_social = trim("{$apellidoPaterno} {$apellidoMaterno} {$nombres}");
                $this->nombre_comercial = '';
                $this->direccion = '';
                $this->departamento = '';
                $this->provincia = '';
                $this->distrito = '';
            } else {
                $this->emit('alert', 'Tipo de documento no soportado para consulta externa.');
            }
        } catch (\Exception $e) {
            $this->emit('alert', 'Error de conexión con APIs.net.pe: ' . $e->getMessage());
        }
    }









    public function searchRucAntiguo()
    {
        $tipodocumento = Tipodocumento::find($this->tipodocumento_id); //ruc , dni
        $numecar = Str::length($this->ruc); //calcula la longitud de ruc, dni, ce, etc..

        //si loescogido es 1(dni), 4, 6(ruc)
        switch ($tipodocumento->codigo) {
            case '1':
                //indicar 8 digitos dni
                if ($numecar != 8) {
                    $this->emit('alert', 'el DNI Debe tener 8 digitos');
                    return;
                }
                break;
            case '4':
                //carnet de extranjeria

                break;
            case '6':
                //ruc
                if ($numecar != 11) {
                    $this->emit('alert', 'el RUC Debe tener 11 digitos');
                    return;
                }
                break;
            default:

                break;
        }

        //primero buscaremos en Local
        //dd($this->ruc);
        $query = Customer::where('numdoc', $this->ruc)->first();

        if ($query) {
            $this->razon_social = $query->nomrazonsocial;
            $this->nombre_comercial = $query->nombrecomercial;
            $this->direccion = $query->address ?? null;
            //$this->departamento = $query->department->name; // si es nulo asignarle null

            $this->department_id = $query->department_id ?? null;
            //dd($this->department_id);
            if ($this->department_id) {
                $this->provinces = Province::where('department_id', $this->department_id)->get();
            }

            $this->province_id = $query->province_id ?? null;
            if ($this->province_id) {
                $this->districts = District::where('province_id', $this->province_id)->get();
            }


            //$this->distrito = $query->district->name;
            $this->district_id = $query->district_id ?? null;



            //$this->districts = District::where('province_id', $this->province_id)->get();


        } else {
            $sunat = new \jossmp\sunat\ruc([
                'representantes_legales'     => false,
                'cantidad_trabajadores'     => false,
                'establecimientos'             => false,
                'deuda'                     => false,
            ]);

            $query = $sunat->consulta($this->ruc);

            if ($query->success) {

                $this->razon_social = $query->result->razon_social;
                $this->nombre_comercial = $query->result->nombre_comercial;
                $this->direccion = $query->result->direccion;
                $this->departamento = $query->result->departamento;

                if ($this->departamento) {
                    $departamento = ucwords(strtolower($this->departamento)); //ejemplo Madre De Dios
                    $departamentoEncontrado = Department::where('name', $departamento)->orWhere('name2', $departamento)->first();
                    $this->department_id = $departamentoEncontrado->id;

                    $this->provinces = Province::where('department_id', $this->department_id)->get();
                } else {
                    $this->department_id = NULL;
                }

                $this->provincia = $query->result->provincia;

                if ($this->provincia) {
                    $provincia = ucwords(strtolower($this->provincia));

                    $provinciaEncontrado = $departamentoEncontrado->provinces()
                        ->where(function ($query) use ($provincia) {
                            $query->where('name', $provincia)
                                ->orWhere('name2', $provincia); //para buscar sin las tildes
                        })
                        ->first();

                    $this->province_id = $provinciaEncontrado->id;
                    //dd($this->province_id);
                    $this->districts = District::where('province_id', $this->province_id)->get();
                } else {
                    $this->province_id = NULL;
                }


                $this->distrito = $query->result->distrito;

                if ($this->distrito) {
                    $distrito = ucwords(strtolower($this->distrito));

                    $distritoEncontrado = $provinciaEncontrado->districts()
                        ->where(function ($query) use ($distrito) {
                            $query->where('name', $distrito)
                                ->orWhere('name2', $distrito);
                        })
                        ->first();

                    if ($distritoEncontrado) {
                        $this->district_id = $distritoEncontrado->id;
                    } else {
                        $this->district_id = NULL;
                    }
                } else {
                    $this->district_id = NULL;
                }
            }
        }
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
    }




    public function render()
    {
        $tipodocumentos = Tipodocumento::all();

        return view('livewire.admin.customer-create', compact('tipodocumentos'));
    }


    //en este caso la validación se hace en el nombre de las variables y los campos
    //la validacion no se hace en el nombre de los campos de la tabla
    protected $rules = [
        'tipodocumento_id' => 'required',
        'ruc' => 'required',
        'razon_social' => 'required',
        'nombre_comercial' => '',
        'direccion' => '',
        'department_id' => '',
        'province_id' => '',
        'district_id' => '',
        'company_id' => 'required',
        'phone' => '',
        'movil' => '',
        'whatsapp' => '',
        'email' => '',
        'email2' => '',
        'email3' => '',
        'email4' => '',
        'contact' => '',
        'state' => '',

    ];


    public function save()
    {

        $this->validate();



        if ($this->departamento) {
            $departamento = ucwords(strtolower($this->departamento)); //ejemplo Madre De Dios
            $departamentoEncontrado = Department::where('name', $departamento)->orWhere('name2', $departamento)->first();
            $department_id = $departamentoEncontrado->id;
        } else {
            $department_id = NULL;
        }

        if ($this->provincia) {
            $provincia = ucwords(strtolower($this->provincia));

            $provinciaEncontrado = $departamentoEncontrado->provinces()
                ->where(function ($query) use ($provincia) {
                    $query->where('name', $provincia)
                        ->orWhere('name2', $provincia);
                })
                ->first();

            $province_id = $provinciaEncontrado->id;
        } else {
            $province_id = NULL;
        }



        if ($this->distrito) {
            $distrito = ucwords(strtolower($this->distrito));

            $distritoEncontrado = $provinciaEncontrado->districts()
                ->where(function ($query) use ($distrito) {
                    $query->where('name', $distrito)
                        ->orWhere('name2', $distrito);
                })
                ->first();

            if ($distritoEncontrado) {
                $district_id = $distritoEncontrado->id;
            } else {
                $district_id = NULL;
            }
        } else {
            $district_id = NULL;
        }

        //creamos el registro, en este caso el campo de la tabla no coincide con los nombres de las variables
        //no coincide con los nombres de los text, select, radiobutton , etc
        Customer::create([
            'tipodocumento_id' => $this->tipodocumento_id,
            'numdoc' => $this->ruc, //ojo en validate se valida ruc y no se valida numdoc, se recomienda usar como variable numdoc
            'nomrazonsocial' => $this->razon_social,
            'nombrecomercial' => $this->nombre_comercial,
            'address' => $this->direccion,
            //'department_id' => $this->department_id,
            //'province_id' => $this->province_id,
            //'district_id' => $this->district_id,
            'department_id' => $department_id,
            'province_id' => $province_id,
            'district_id' => $district_id,


            'company_id' => $this->company_id,
            'local_id' => $this->local_id,
            'phone' => $this->phone,
            'movil' => $this->movil,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'email2' => $this->email2,
            'email3' => $this->email3,
            'email4' => $this->email4,
            'contact' => $this->contact,
            'state' => $this->state

        ]);


        $this->emit('alert', 'El Cliente se creo correctamente');
        return redirect()->route('customer.list');
    }
}
