<?php

namespace App\Http\Livewire\Admin;

use App\Models\Boleta;
use App\Models\Resumen;
use Livewire\Component;

use Livewire\WithPagination;
use App\Services\SunatService;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ResumenCreate extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $company, $company_id;
    protected $boletas;
    public $fechadeenvio;
    public $fechaemision;
    //public $total;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    public function mount()
    {
        $this->company = auth()->user()->employee->company;
        $this->company_id = auth()->user()->employee->company->id; //compañia logueaada
    }


    public function loadResumenes()
    {
        $this->readyToLoad = true;
    }


    public function updatedFechaemision()
    {
        $this->loadResumenes();
    }


    public function render()
    {

        if ($this->readyToLoad) {
            $company_id = auth()->user()->employee->company->id; //compania logueada
            $local_id = auth()->user()->employee->local->id; //local logueado

            $query = Boleta::select('id', 'serienumero', 'total', 'fechaemision')
                ->where('company_id', $company_id)
                ->where('local_id', $local_id)
                ->orderBy($this->sort, $this->direction);

            if ($this->fechaemision) {
                $query->whereDate('fechaemision', $this->fechaemision);
            }

            $boletas = $query->paginate($this->cant);
        } else {
            $boletas = [];
        }

        $this->boletas = $boletas;
        //$this->total = $this->total + 5;
        return view('livewire.admin.resumen-create', ['boletas' => $this->boletas]);
    }


    // Guardamos el resumen
    public function save()
    {

        dd($this->boletas);


        //dd($this->total);

        // Crear instancia de SunatService
        $sunatService = new SunatService(null, $this->company, null, null, $this->boletas);
        $company = $sunatService->getCompany();


        // Generar detalles dinámicamente desde las boletas
        $details = [];
        foreach ($this->boletas as $boleta) {
            $detail = new SummaryDetail();
            $detail->setTipoDoc('03')
                ->setSerieNro($boleta->serienumero)
                ->setEstado('1')
                ->setClienteTipo('1')
                ->setClienteNro('00000000')
                ->setTotal($boleta->total)
                ->setMtoOperGravadas($boleta->mto_oper_gravadas)
                ->setMtoOperExoneradas($boleta->mto_oper_exoneradas)
                ->setMtoOperInafectas($boleta->mto_oper_inafectas)
                ->setMtoIGV($boleta->mto_igv)
                ->setMtoISC($boleta->mto_isc);
            $details[] = $detail;
        }

        $resumen = new Summary();
        $resumen->setFecGeneracion(new \DateTime($this->fechaemision))
            ->setFecResumen(new \DateTime($this->fechadeenvio))
            ->setCorrelativo('001')
            ->setCompany($company)
            ->setDetails($details);

        // Obtener See configurado
        $this->getSee();

        $sunat = new SunatService(null, $this->company, null, null, $this->boletas);
        $result = $sunat->send($resumen);

        // Guardar XML
        file_put_contents($resumen->getName() . '.xml', $sunat->getFactory()->getLastXml());

        if (!$result->isSuccess()) {
            // Si hubo error al conectarse al servicio de SUNAT.
            var_dump($result->getError());
            exit();
        }

        $ticket = $result->getTicket();
        echo 'Ticket : ' . $ticket . PHP_EOL;

        $statusResult = $sunat->getStatus($ticket);
        if (!$statusResult->isSuccess()) {
            // Si hubo error al conectarse al servicio de SUNAT.
            var_dump($statusResult->getError());
            return;
        }

        echo $statusResult->getCdrResponse()->getDescription();
        // Guardar CDR
        file_put_contents('R-' . $resumen->getName() . '.zip', $statusResult->getCdrZip());
    }




   /*  public function getBoletas()
    {
        $company_id = auth()->user()->employee->company->id;

        $query = Boleta::select('id', 'serienumero', 'total', 'fechaemision', 'mto_oper_gravadas', 'mto_oper_exoneradas', 'mto_oper_inafectas', 'mto_igv', 'mto_isc')
            ->where('company_id', $company_id)
            ->orderBy($this->sort, $this->direction);

        if ($this->fechaemision) {
            $query->whereDate('fechaemision', $this->fechaemision);
        }

        return $query->get();
    }

    public function getBoletasProperty()
    {
        return $this->boletas;
    }
 */

}
