<?php

namespace App\Http\Livewire\Admin;

use Greenter\See;
use App\Models\Local;
use App\Models\Boleta;
use App\Models\Local_tipocomprobante;
use App\Models\Resumen;

use Livewire\Component;
use Livewire\WithPagination;
use Greenter\Model\Summary\Summary;
use Illuminate\Support\Facades\Storage;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\Model\Summary\SummaryDetail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ResumenCreatee extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $company, $company_id, $serie;
    public $fechaemision, $fechadeenvio;
    public $boletas = [];
    public $local_id;
    public $local_tipocomprobante;
    public $numcomprobantes;
    public $employee_id;

    protected $rules = [
        'fechaemision' => 'required|date',
    ];


    public function mount()
    {
        $this->company = auth()->user()->employee->company;
        $this->company_id = auth()->user()->employee->company->id; //compañia logueaada
        $this->local_id = auth()->user()->employee->local->id;
        $this->employee_id = auth()->user()->employee->id;

        //$this->serie =

        $this->serie = Local_tipocomprobante::where('local_id', $this->local_id)
                                                                ->where('company_id', $this->company_id)
                                                                ->where('tipocomprobante_id', 2)->value('serie');

        //$this->serie
        //$this->fechadeenvio = now();
    }



    public function updatedFechaemision()
    {
        $this->boletas = Boleta::whereDate('fechaemision', $this->fechaemision)
            ->where('company_id', $this->company_id)
            ->where('local_id', $this->local_id)
            ->whereNull('resumen_id')//es null si las boletas no pertenecen a un resumen
            ->whereNull('sunat_cdr_path')//controla boletas enviadas directamente es null si no se envio a sunat
            ->orderBy('id', 'desc')
            ->get();

        // Obtener el número de registros
        $this->numcomprobantes = $this->boletas->count();
    }

    public function save()
    {

        //dd($this->serie);

        $this->validate();
        $this->fechadeenvio = now()->format('Y-m-d');



        $endpoint = $this->company->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA;

        // Crear instancia de See
        $see = new See();
        $see->setService($endpoint);
        // Configurar el certificado y la clave
        $see->setCertificate(Storage::disk('s3')->get($this->company->certificate_path));
        //$see->setCertificate(file_get_contents(storage_path('app/certificates/cert.pem')));
        //$see->setCredentials('20000000001MODDATOS', 'moddatos');
        $see->setClaveSOL($this->company->ruc, $this->company->soluser, $this->company->solpass);


        // Crear la compañía
        $company = new \Greenter\Model\Company\Company();
        $company->setRuc($this->company->ruc)
            ->setRazonSocial($this->company->razonsocial)
            ->setNombreComercial($this->company->nombrecomercial)
            ->setAddress((new \Greenter\Model\Company\Address())
                ->setUbigueo($this->company->ubigueo)
                ->setDepartamento($this->company->department->name)
                ->setProvincia($this->company->province->name)
                ->setDistrito($this->company->district->name)
                ->setUrbanizacion("urbanización")
                ->setDireccion($this->company->direccion));

        // Generar detalles dinámicamente desde las boletas
        $details = [];
        foreach ($this->boletas as $boleta) {
            $detail = new SummaryDetail();
            $detail->setTipoDoc('03')
                ->setSerieNro($boleta->serienumero)
                ->setEstado('1')
                ->setClienteTipo('1')
                ->setClienteNro($boleta->cliente_nro)
                ->setTotal($boleta->total)
                ->setMtoOperGravadas($boleta->mto_oper_gravadas)
                ->setMtoOperExoneradas($boleta->mto_oper_exoneradas)
                ->setMtoOperInafectas($boleta->mto_oper_inafectas)
                ->setMtoIGV($boleta->mto_igv)
                ->setMtoISC($boleta->mto_isc);
            $details[] = $detail;
        }

        // Crear el resumen
        $resumen = new Summary();
        $resumen->setFecGeneracion(new \DateTime($this->fechaemision))
            ->setFecResumen(new \DateTime($this->fechadeenvio))
            ->setCorrelativo('001')
            ->setCompany($company)
            ->setDetails($details);

        // Enviar resumen a SUNAT
        $result = $see->send($resumen);


        $resumensboleta = new Resumen();
        $resumensboleta->fechaescogida = $this->fechaemision;
        $resumensboleta->fechadeenvio = $this->fechadeenvio;
        $resumensboleta->serie = $this->serie;
        $resumensboleta->state = true;
        $resumensboleta->company_id = $this->company_id;
        $resumensboleta->local_id = $this->local_id;
        $resumensboleta->employee_id = $this->employee_id;
        $resumensboleta->numcomprobantes = $this->numcomprobantes;
        $resumensboleta->xml = 'fe/' . $this->company->id . '/invoices/resumen/xml/' . $resumen->getName() . '.xml';


        // Guardar XML
        // file_put_contents(public_path('invoices/xml/' . $resumen->getName() . '.xml'), $see->getFactory()->getLastXml());

        // Crear directorio si no existe

        /* if (!File::exists($xmlPath)) {
            File::makeDirectory($xmlPath, 0755, true);
        } */
        $xml = $see->getFactory()->getLastXml();

        // $xmlPath = 'fe/'.$this->company->id.'/invoices/resumen/xml/' . $resumen->getName() . '.xml';

        // $xmlPath = public_path('storage/invoices/xml/');
        // file_put_contents($xmlPath . $resumen->getName() . '.xml', $see->getFactory()->getLastXml());
        Storage::disk('s3')->put($resumensboleta->xml, $xml, 'public');



        /* $this->boleta->xml_path = 'invoices/xml/' . $this->voucher->getName() . '.xml';
        Storage::put($this->boleta->xml_path, $xml, 'public'); //esto funciona en local */



        if (!$result->isSuccess()) {
            // Si hubo error al conectarse al servicio de SUNAT.
            session()->flash('error', 'Error al enviar el resumen: ' . $result->getError()->getMessage());
            return;
        }

        $resumensboleta->ticket = $result->getTicket();

        // $ticket = $result->getTicket();
        session()->flash('message', 'Ticket: ' . $resumensboleta->ticket);

        // Consultar el estado del resumen
        $statusResult = $see->getStatus($resumensboleta->ticket);
        if (!$statusResult->isSuccess()) {
            // Si hubo error al conectarse al servicio de SUNAT.
            session()->flash('error', 'Error al consultar el estado del resumen: ' . $statusResult->getError()->getMessage());
            return;
        }

        session()->flash('message', 'Estado: ' . $statusResult->getCdrResponse()->getDescription());

        // Guardar CDR
        //file_put_contents(public_path('invoices/cdr/R-' . $resumen->getName() . '.zip'), $statusResult->getCdrZip());
        // Guardar CDR
        // file_put_contents($xmlPath . 'R-' . $resumen->getName() . '.zip', $statusResult->getCdrZip());

        $resumensboleta->cdr = 'fe/' . $this->company->id . '/invoices/resumen/cdr/R-' . $resumen->getName() . '.zip';
        Storage::disk('s3')->put($resumensboleta->cdr, $statusResult->getCdrZip(), 'public');

        $resumensboleta->save();


        // Actualizar el campo resumen_id de todas las boletas
        foreach ($this->boletas as $boleta) {
            $boleta->resumen_id = $resumensboleta->id;
            $boleta->save();
        }
    }



    public function render()
    {
        return view('livewire.admin.resumen-createe', [
            'boletas' => $this->boletas,
        ]);
    }
}
