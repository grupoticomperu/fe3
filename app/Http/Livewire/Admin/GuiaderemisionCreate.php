<?php

namespace App\Http\Livewire\Admin;

use App\Models\Um;
use Carbon\Carbon;
use App\Models\Guia;
use App\Models\Local;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Vehiculo;
use App\Models\Conductor;
use App\Models\Department;
use App\Models\Temporalgr;
use App\Models\Comprobante;
use App\Models\Tipodocumento;
use App\Models\Transportista;
use App\Models\Motivotraslado;
use App\Models\Puntodepartida;
use App\Services\SunatService;
use App\Models\Comprobante_Product;
use App\Models\Local_tipocomprobante;


class GuiaderemisionCreate extends Component
{

    public $company, $comprobante;
    public $company_id;
    public $tipocomprobante_id = 7; //si es NC Boleta, NC Factura, si es guia de remision = 7
    public $tipocomprobante_namecorto;
    public $serie;
    public $numero;
    public $boleta;

    public $tipodocumento_id;
    public $serienumero, $local_id, $ruc, $customer_id; //$departamento = "LIMA", $provincia = "LIMA", $distrito = "LIMA";
    public $local_tipocomprobante_id;
    public $fechaemision, $motivotraslado_id = "", $modalidaddetraslado = "", $fechadetraslado;
    public $pesototal, $um_id = "", $conductor_id = "", $vehiculo_id = "", $puntodepartida_id = "";
    public $transportista_id = "", $ubigeollegada;
    public $department_id = "", $province_id = "", $district_id = "";
    public $departments, $provinces = [], $districts = [], $direccionllegada;
    public $datosEliminados = false;
    public $details = [];
    public $isCreated = false; // Para saber si ya se guardó

    /*     public $item = [
        'cant' => '',
        'product_id' => '',
        'comprobante_id' => '',
        'company_id' => '',
        'codigobarras' => '',
    ]; */

    //public $sending_method;

    protected $listeners = ['delete', 'limpiar'];

    public function mount(Comprobante $id)
    {
        $this->comprobante = $id; //$this->comprobante es el comprobante al cual se esta haciendo guia de remisión
        if ($this->comprobante->tipocomprobante_id != 1 && $this->comprobante->tipocomprobante_id != 2) {
            abort(403, 'Sólo se hace Guias de Facturas y Boletas.');
            return;
        }

        $this->departments = Department::all(); //lista todo los departamentos
        $this->company = auth()->user()->employee->company;
        $this->company_id = auth()->user()->employee->company->id; //compañia logueaada

        $this->fechaemision = Carbon::now()->format('Y-m-d');
        //$this->fechadetraslado = Carbon::now()->format('Y-m-d');

        $this->ruc = $this->comprobante->numdoc; //numero de ruc o dni del documento que se realizara guia osea del cliente o destinatario
        $this->customer_id = $this->comprobante->customer_id; //id del cliente

        $this->tipodocumento_id = $this->comprobante->tipodocumento_id; //para ver si el dni, ruc, ce

        $local = auth()->user()->employee->local;


        $this->serie = $local->tipocomprobantes
            ->where('id', $this->tipocomprobante_id)
            ->first()
            ->pivot
            ->serie ?? "null";

        $lastGuia = Guia::where('company_id', $this->company_id)
            ->where('serie', $this->serie)
            ->latest('numero')
            ->first();

        if ($lastGuia) {
            $this->numero = $lastGuia->numero + 1;
        } else {
            //busco en la tabla companies configuracion dende se puso el numero
            $lastGuia = Local_tipocomprobante::where('company_id', $this->company_id)
                ->where('serie', $this->serie)
                ->where('local_id', auth()->user()->employee->local->id)
                //->where('tipocomprobante_id', 3)
                ->first();
            if ($lastGuia)
                $this->numero = $lastGuia->inicio;
        }

        //$this->initialize($id);
        if (!$this->datosEliminados) {
            $this->datosEliminados = true;
            $this->company_id = auth()->user()->employee->company->id;
            $temporalgr = Temporalgr::where('company_id', $this->company_id)
                ->where('employee_id', auth()->user()->employee->id)->get();

            /* Temporalnc::where('company_id', $this->company_id)
                ->where('employee_id', auth()->user()->employee->id)->delete(); */
            if ($temporalgr->isNotEmpty()) {
                $temporalgr->each->delete();
            }
            //obtenemos detalle de comprobante de una compania,falta restringir por local y usuario
            $detalle = Comprobante_Product::where('comprobante_id', $this->comprobante->id)
                ->where('company_id', $this->company_id)->get(); //falta restringir para que solo ,uestre lo que le corresponde osea no de otro local ni de otra empresa
            //Guardamos
            $this->llenartemporal($detalle);
        }
    }


    public function llenartemporal($detalle)
    {
        foreach ($detalle as $item) {
            Temporalgr::create([
                //'serienumero' => $item->comprobante->serienumero,
                'quantity' => $item->cant,
                //'saleprice' => $item->price,
                //'subtotal' => $item->subtotal,
                'product_id' => $item->product_id,

                'company_id' => $item->company_id,
                'employee_id' => auth()->user()->employee->id,
                'codigobarras' => $item->codigobarras, //codigo del producto que necesita la facturacion electronica
                //'igv' => $item->igv,
                //'icbper' => $item->icbper,
                //'totalimpuestos' => $item->totalimpuestos,
                //'mtovalorunitario' => floatval($mtovalorunitario),
                //'mtovalorventa' => floatval($item->mtovalorventa),
                //'mtobaseigv' => floatval($item->mtobaseigv),
                'name' => $item->product->name,
                'um' => $item->product->um->abbreviation,
                //'tipafeigv' => $item->product->tipoafectacion->codigo,
                //'porcentajeigv' => $this->igv,  //igv lo tenemos en el mount es 18%
                //'factoricbper' => $this->factoricbper,  //factoricbper lo tenemos en el mount es 0.2
            ]);
        }
    }


    public function updatedDepartmentId($value)
    {
        $this->provinces = Province::where('department_id', $value)->get();
        $this->reset(['province_id', 'district_id']);
    }



    public function updatedProvinceId($value)
    {
        $this->districts = District::where('province_id', $value)->get();
        $this->reset('district_id');
    }


    //guardamos el comprobante
    public function save()
    {
        
        $this->validate([
            'motivotraslado_id'      => 'required',
            'modalidaddetraslado'    => 'required',
            'fechadetraslado'        => 'required|date',
            'pesototal'              => 'required|numeric|min:0.1',
            'um_id'                  => 'required|exists:ums,id',
            'puntodepartida_id'      => 'required|exists:puntodepartidas,id',
            'direccionllegada'       => 'required|string|min:3',
            'department_id'          => 'required|exists:departments,id',
            'province_id'            => 'required|exists:provinces,id',
            'district_id'            => 'required|exists:districts,id',
        ], [
            // Mensajes personalizados
            'motivotraslado_id.required'   => 'Debe seleccionar el motivo del traslado.',
            'modalidaddetraslado.required' => 'Debe seleccionar la modalidad del traslado.',
            'fechadetraslado.required'     => 'Debe indicar la fecha de traslado.',
            'pesototal.required'           => 'Debe ingresar el peso total.',
            'pesototal.min'                => 'El peso total debe ser mayor a 0.',
            'um_id.required'               => 'Debe seleccionar una unidad de medida.',
            'puntodepartida_id.required'   => 'Debe seleccionar el punto de partida.',
            'direccionllegada.required'    => 'Debe ingresar la dirección de llegada.',
            'department_id.required'       => 'Debe seleccionar el departamento de llegada.',
            'province_id.required'         => 'Debe seleccionar la provincia de llegada.',
            'district_id.required'         => 'Debe seleccionar el distrito de llegada.',
        ]);


        /* if ($this->modalidaddetraslado === '01') {
            if (empty($this->transportista_id)) {
                $this->emit('alert', 'Debe seleccionar el transportista (Transporte Público).');
                return;
            }
        } */



        // 🚛 Modalidad Pública (01) solo acepta empresas en los registros
        if ($this->modalidaddetraslado === '01') {
            if (empty($this->transportista_id)) {
                $this->addError('transportista_id', 'Debe seleccionar un transportista (Transporte Público).');
                $this->emit('alert', 'Debe seleccionar un transportista.');
                return;
            }

            // Asegura que sea numérico, no cadena
            $this->transportista_id = (int) $this->transportista_id;

            // Limpia los campos no aplicables
            $this->vehiculo_id = null;
            $this->conductor_id = null;
        }




        // Modalidad Privada (02)
        if ($this->modalidaddetraslado === '02') {
            if (empty($this->vehiculo_id)) {
                $this->addError('vehiculo_id', 'Debe seleccionar un vehículo (Transporte Privado).');
                $this->emit('alert', 'Debe seleccionar un vehículo.');
                return;
            }
            if (empty($this->conductor_id)) {
                $this->addError('conductor_id', 'Debe seleccionar un conductor (Transporte Privado).');
                $this->emit('alert', 'Debe seleccionar un conductor.');
                return;
            }

            // Limpia el transportista
            $this->transportista_id = null;
        }




        /* if ($this->modalidaddetraslado === '02') {
            if (empty($this->vehiculo_id)) {
                $this->emit('alert', 'Debe seleccionar un vehículo (Transporte Privado).');
                return;
            }
            if (empty($this->conductor_id)) {
                $this->emit('alert', 'Debe seleccionar un conductor (Transporte Privado).');
                return;
            }
        } */


        $this->ubigeollegada = $this->district_id;
        $this->local_id = auth()->user()->employee->local->id;
        //factura. boleta
        $this->local_tipocomprobante_id = Local_tipocomprobante::where('local_id', $this->local_id)->where('tipocomprobante_id', $this->tipocomprobante_id)->value('id');

        $this->serienumero = $this->serie . "-" . $this->numero;


        //guardamos en $temporals todo lo que se va gravar en la tabla comprobante_product
        $temporals = Temporalgr::where('company_id', auth()->user()->employee->company->id)
            ->where('employee_id', auth()->user()->employee->id)->get();


        $temporalsData = $temporals->map(function ($temporal) {
            return [
                'cant' => $temporal->quantity,
                'product_id' => $temporal->product_id,
                'name' => $temporal->name,
                'company_id' => $this->company_id,
                'codigobarras' => $temporal->codigobarras,
            ];
        });





        $this->boleta = Guia::create([
            'details' => $temporalsData->toJson(),
            'serie' => $this->serie,
            'numero' => $this->numero,
            'serienumero' => $this->serienumero,
            'fechaemision' =>  $this->fechaemision,
            'comprobante_id' => $this->comprobante->id, //la guia tiene el id del comprobante, no del comprobante creado, sino del comprobante relacionado(factura o boleta) al que se hizo guia
            'company_id' =>  $this->company_id,
            'customer_id' => $this->customer_id,
            'motivotraslado_id' => $this->motivotraslado_id,
            'modalidaddetraslado' => $this->modalidaddetraslado,
            'fechadetraslado' => $this->fechadetraslado,
            'pesototal' => $this->pesototal,
            'um_id' => $this->um_id,
            /*  'numpaquetes' => $this->numpaquetes,
            'descripcion' => $this->descripcion,
            'observacion' => $this->observacion, */
            'transportista_id' => $this->transportista_id,
            'direccionllegada' => $this->direccionllegada,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'ubigeollegada' => $this->ubigeollegada,
            'puntodepartida_id' => $this->puntodepartida_id,


        ]);

        if ($this->modalidaddetraslado == '02') {
            $this->boleta->vehiculos()->attach($this->vehiculo_id);
            $this->boleta->conductors()->attach($this->conductor_id);
        }

        $sunat = new SunatService($comprobante = null, $this->company, $temporals, $this->boleta, null, null);

        $sunat->getSeeApi($this->company);
        $sunat->setDespatch();
        $sunat->sendDespatch();
        //$sunat->generatePdfReport();

        $this->isCreated = true;

        $this->emit('alert', 'La guia se creo correctamente');
    }


    public function render()
    {

        $motivotraslados = Motivotraslado::all(); //restringir para que muestre solo de su compañia
        $tipodocumentos = Tipodocumento::all();
        $ums = Um::all();
        $transportistas = Transportista::all();
        $conductors = Conductor::all();
        $vehiculos = Vehiculo::all();
        $puntodepartidas = Puntodepartida::all();
        $cart = Temporalgr::all();

        return view('livewire.admin.guiaderemision-create', compact('motivotraslados', 'tipodocumentos', 'ums', 'transportistas', 'conductors', 'vehiculos', 'puntodepartidas', 'cart'));
    }

    public function cancel()
    {
        return redirect()->route('admin.comprobante.list');
    }
}
