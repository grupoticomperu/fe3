<?php

namespace App\Http\Livewire\Admin;

use App\Models\Boletadiseno;
use App\Models\Company;
use Livewire\Component;
use App\Models\Currency;
use App\Models\District;
use App\Models\Province;
use App\Models\Department;
use App\Models\Facturadiseno;
use App\Models\Guiadiseno;
use App\Models\Ncboletadiseno;
use App\Models\Ncfacturadiseno;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Crypt;

class CompanyEdit extends Component
{

    use WithFileUploads;

    public $company; //guardaremos el company logueado
    public $companysolicitado; //para controlar que modifique su empresa y no de otras
    public $ruc, $razonsocial, $direccion;
    public $departments, $provinces = [], $districts = [], $currencies;
    public $department_id = "", $province_id = "", $district_id = "";
    public $nombrecomercial;
    public $soluser, $solpass, $cliente_id, $cliente_secret;
    public $logo, $logoback;
    public $certificate_path, $certificate_pathback;
    public $fechainiciocertificado;
    public $fechafincertificado;
    public $currency_id = "";
    public $production = "", $ubigeo, $celular, $telefono, $correo, $smtp, $password, $puerto;
    public $boletadisenos, $facturadisenos, $guiadisenos, $ncfacturadisenos, $ncboletadisenos;
    public $boletadiseno_id = "", $facturadiseno_id = "", $guiadiseno_id = "", $ncfacturadiseno_id = "", $ncboletadiseno_id = "";

    protected $listeners = ['fechaInicioSeleccionada']; //se escucha este evento, para adicionar 1 año al certificado

    public function mount($id)
    {
        $this->company = auth()->user()->employee->company;
        //$this->company = Company::find(1);//porque solo va existir una sola
        //$this->company_id = auth()->user()->employee->company->id; //compañia logueaada
        if ($id != $this->company->id) //para identificar al usuario logueado
        {
            return;
        }

        $this->ruc = $this->company->ruc;
        $this->razonsocial = $this->company->razonsocial;
        $this->direccion = $this->company->direccion;
        $this->soluser = $this->company->soluser;
        $this->solpass = $this->company->solpass;
        $this->cliente_id = $this->company->cliente_id;
        $this->cliente_secret = $this->company->cliente_secret;
        //$this->certificate_path = $this->company->certificate_path; //esto no va, para que certificate_path tome valor cuando se escoja  el certificado
        $this->certificate_pathback = $this->company->certificate_path; //certificate_pathback  muestra el certificado actual
        //$this->logo = $this->company->logo; //esto no va, para que logo tome valor cuando se escoja la imagen
        $this->logoback = $this->company->logo; //logoback muestra el logo actual


        if ($this->company->department_id) { //comprobamos que exista sino toma valor "" y en el select dira escoger o seleccionar
            $this->department_id = str_pad((string)$this->company->department_id, 2, '0', STR_PAD_LEFT); //por ejeplo si es 1 le agrega 0 para que sea 01
        }
        if ($this->company->province_id) {
            $this->province_id = str_pad((string)$this->company->province_id, 4, '0', STR_PAD_LEFT); //$this->company->province_id;
        }
        if ($this->company->district_id) {
            $this->district_id = str_pad((string)$this->company->district_id, 6, '0', STR_PAD_LEFT); //$this->company->district_id;  estaba 2 le puse 6
        }

        $this->departments = Department::all(); //lista todo los departamentos
        $this->provinces = Province::where('department_id', $this->department_id)->get();
        $this->districts = District::where('province_id', $this->province_id)->get();

        //$this->currency_id = $this->company->currency_id == null ? '': $this->company->currency_id;
        $this->currency_id = $this->company->currency_id ?? '';
        $this->currencies = Currency::all(); //lista Monedas
        $this->boletadisenos = Boletadiseno::all(); //lista Monedas
        $this->facturadisenos = Facturadiseno::all(); //lista Monedas
        $this->guiadisenos = Guiadiseno::all(); //lista Monedas
        $this->ncfacturadisenos = Ncfacturadiseno::all(); //lista Monedas
        $this->ncboletadisenos = Ncboletadiseno::all(); //lista Monedas

        $this->production = $this->company->production;
        $this->nombrecomercial = $this->company->nombrecomercial;
        $this->ubigeo = $this->company->ubigeo;
        $this->celular = $this->company->celular;
        $this->telefono = $this->company->telefono;
        $this->puerto = $this->company->puerto;

        $this->fechainiciocertificado = $this->company->fechainiciocertificado;
        $this->fechafincertificado = $this->company->fechafincertificado;

        $this->correo = $this->company->correo;
        $this->smtp = $this->company->smtp;
        $this->password = $this->company->password;
        //$this->smtp = $this->company->smtp;

        $this->boletadiseno_id =  $this->company->boletadiseno_id; 
        $this->facturadiseno_id =  $this->company->facturadiseno_id;
        $this->guiadiseno_id =  $this->company->guiadiseno_id;
        $this->ncfacturadiseno_id =  $this->company->ncfacturadiseno_id; 
        $this->ncboletadiseno_id =  $this->company->ncboletadiseno_id;

    }




    public function fechaInicioSeleccionada($fechaInicio) //aqui se adiciona 1 año a la fecha seleccionado del certificado
    {
        $this->fechainiciocertificado = $fechaInicio;
        $this->fechafincertificado = date('Y-m-d', strtotime($fechaInicio . ' +1 year'));
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
        $this->ubigeo = $this->district_id;
    }



    protected $rules = [
        'ruc' => 'required',
        'razonsocial' => 'required',
        'nombrecomercial' => 'required',
        'direccion' => 'required',
        'ubigeo' => 'required',
        'celular' => 'nullable',
        'telefono' => 'nullable',
        'department_id' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
        'soluser' => 'required',
        'solpass' => 'required',
        'cliente_id' => 'nullable',
        'cliente_secret' => 'nullable',
        'currency_id' => 'required',
        'production' => 'required',
        'correo' => 'required',
        'smtp' => 'nullable',
        'password' => 'nullable',
        'puerto' => 'nullable',
        'fechainiciocertificado' => 'nullable',
        'fechafincertificado' => 'nullable',
        //'logo' => 'required',
    ];



    public function save()
    {
        // Base rules
        $rules = $this->rules;

        // Ajustamos reglas dinámicamente según la lógica del componente
        /*  if ($this->certificate_path) {
            $rules['certificate_path'] = 'required|file|mimes:pem,txt';
        } else {
            $rules['certificate_path'] = 'nullable';
        } */



        if ($this->logo) {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['logo'] = 'nullable';
        }

        // ✅ Validamos TODO una sola vez
        $validated = $this->validate($rules);

        // Subimos archivos si existen
        /* $certificate_pathoo = $this->certificate_path
            ? Storage::disk('s3')->put('fe/' . $this->company->razonsocial . '/certificados', $this->certificate_path, 'public')
            : $this->company->certificate_path; */

        /* $certificate_pathoo = $this->certificate_path
            ? Storage::disk('s3')->putFile(
                'fe/' . $this->company->razonsocial . '/certificados', 
                $this->certificate_path, 
                'public' 
            )
            : $this->company->certificate_path; */



        /* if ($this->certificate_path) {
            $originalName = pathinfo($this->certificate_path->getClientOriginalName(), PATHINFO_FILENAME);
            $newName = $originalName . '.pem';

            $certificate_pathoo = Storage::disk('s3')->putFileAs($this->company->razonsocial . '/certificados', $this->certificate_path, $newName, 'private');
        } */


        if ($this->certificate_path) {

            // Obtener nombre original REAL
            //$originalName = $this->certificate_path->getClientOriginalName();

            // Extraer extensión correctamente
            // $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));


            // Validar SOLO PEM
            /* if ($extension !== 'pem') {
                throw new \Exception(
                    'El certificado debe estar en formato PEM. Archivo detectado: ' . $originalName
                );
            } */

            // 1) Nombre original y extensión
            $originalName = $this->certificate_path->getClientOriginalName();
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            if ($extension !== 'pem') {
                throw new \Exception('El certificado debe estar en formato PEM. Archivo detectado: ' . $originalName);
            }

            // 2) Tamaño máximo (ej: 2MB)
            $maxBytes = 2 * 1024 * 1024;
            if ($this->certificate_path->getSize() > $maxBytes) {
                throw new \Exception('El archivo PEM es demasiado grande (máx 2MB).');
            }

            // 3) Leer contenido y validar que tenga CERT + PRIVATE KEY
            $pem = file_get_contents($this->certificate_path->getRealPath());

            $hasCert = preg_match('/-----BEGIN CERTIFICATE-----.*?-----END CERTIFICATE-----/s', $pem);
            $hasKey  = preg_match('/-----BEGIN (?:RSA )?PRIVATE KEY-----.*?-----END (?:RSA )?PRIVATE KEY-----/s', $pem);

            if (!$hasCert || !$hasKey) {
                throw new \Exception('El PEM debe contener: CERTIFICATE y PRIVATE KEY (misma cadena).');
            }



            // Nombre seguro
            $newName = 'certificate_' . time() . '.pem';

            // Guardar en S3 (privado)
            $path = Storage::disk('s3')->putFileAs(
                $this->company->razonsocial . '/certificados',
                $this->certificate_path,
                $newName,
                'private'
            );
        }else {
            $path = $this->certificate_pathback;
        }

        //$encryptedPassword = Crypt::encryptString($this->certificate_password);

        $logoo = $this->logo
            ? Storage::disk('s3_public')->put('fe/' .$this->company->razonsocial . '/logos', $this->logo, 'public')
            : $this->company->logo;

        // Actualizamos el modelo
        $this->company->update([
            'ruc' => $this->ruc,
            'razonsocial' => $this->razonsocial,
            'nombrecomercial' => $this->nombrecomercial,
            'direccion' => $this->direccion,
            'ubigeo' => $this->ubigeo,
            'celular' => $this->celular,
            'telefono' => $this->telefono,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'soluser' => $this->soluser,
            'solpass' => $this->solpass,
            'cliente_id' => $this->cliente_id,
            'cliente_secret' => $this->cliente_secret,
            'currency_id' => $this->currency_id,
            'production' => $this->production,
            'correo' => $this->correo,
            'smtp' => $this->smtp,
            'password' => $this->password,
            'puerto' => $this->puerto,
            'certificate_path' => $path,
            //'certificate_password' => $encryptedPassword,
            'fechainiciocertificado' => $this->fechainiciocertificado,
            'fechafincertificado' => $this->fechafincertificado,
            'logo' => $logoo,
        ]);

        $this->emit('alert', 'Los datos de tu Empresa se actualizaron correctamente');
    }



    public function render()
    {
        return view('livewire.admin.company-edit');
    }
}
