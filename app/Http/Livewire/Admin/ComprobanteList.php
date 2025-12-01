<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Impuesto;
use App\Models\Temporal;
use App\Models\Temporalnc;
use App\Models\Comprobante;
use Livewire\WithPagination;
use App\Services\SunatService;
use App\Models\Comprobante_Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ComprobanteList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    //public $shopping;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $company;
    public $igv, $factoricbper;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    /*public $temporal = [
        'company_id' => [],
        'product_id' => [],
        'codigobarras' => [],
        'employee_id' => [],
        'image' => [],
        'name' => [],
        'um' => [],
        'tipafeigv' => [],
        'saleprice' => [],
        'mtovalorunitario' => [],
        'porcentajeigv' => [],
        'factoricbper' => [],
        'discount' => [],
        'salepricef' => [],
        'quantity' => [],
        'subtotal' => [],
        'igv' => [],
        'totalimpuestos' => [],
        'icbper' => [],
        'mtovalorventa' => [],
        'mtobaseigv' => [],
        'esbolsa' => [],
    ]; */


    public function mount()
    {
        $this->company = auth()->user()->employee->company; //compania logueada
        $this->igv = Impuesto::where('siglas', 'IGV')->value('valor'); //es el 18%
        $this->factoricbper = Impuesto::where('siglas', 'ICBPER')->value('valor'); //es 0.2
    }


    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadComprobantes()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {

            $company_id = auth()->user()->employee->company->id;
            $local_id = auth()->user()->employee->local->id;

            $query = Comprobante::query()
                ->join('customers', 'customers.id', '=', 'comprobantes.customer_id')
                ->select(
                    'comprobantes.id',
                    'comprobantes.serienumero',
                    'comprobantes.valorventa',
                    'comprobantes.totalimpuestos',
                    'comprobantes.mtoimpventa',
                    'comprobantes.currency_id',
                    'comprobantes.customer_id',
                    'comprobantes.tipocomprobante_id',
                    'customers.nomrazonsocial as razonsocial'
                )
                ->where('comprobantes.company_id', $company_id)
                ->where('comprobantes.local_id', $local_id)
                ->where('comprobantes.serienumero', 'like', '%' . $this->search . '%');

            // 🔽 Ordenamiento dinámico
            if ($this->sort === 'serienumero') {
                $query->orderByRaw('SUBSTRING_INDEX(comprobantes.serienumero, "-", 1) ' . $this->direction)
                    ->orderByRaw('CAST(SUBSTRING_INDEX(comprobantes.serienumero, "-", -1) AS UNSIGNED) ' . $this->direction);
            } elseif ($this->sort === 'razonsocial') {
                $query->orderBy('customers.nomrazonsocial', $this->direction);
            } else {
                $query->orderBy('comprobantes.' . $this->sort, $this->direction);
            }

            $comprobantes = $query->paginate($this->cant);
        } else {
            $comprobantes = [];
        }

        return view('livewire.admin.comprobante-list', compact('comprobantes'));
    }



    public function renderback()
    {
        if ($this->readyToLoad) {

            $company_id = auth()->user()->employee->company->id; //compania logueada
            $local_id = auth()->user()->employee->local->id; //local logueado

            /* $comprobantes = Comprobante::with('customer', 'local')->addSelect([
                'nomrazonsocial' => Customer::select('nomrazonsocial')->whereColumn('id', 'comprobantes.customer_id')
            ])->select('serienumero', 'valorventa','totalimpuestos','mtoimpventa', 'currency_id')
            ->where('company_id', $company_id)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant); */

            //lista de comprobantes
            /*  $comprobantes = Comprobante::select('id', 'serienumero', 'valorventa', 'totalimpuestos', 'mtoimpventa', 'currency_id', 'customer_id', 'tipocomprobante_id')
                ->where('serienumero', 'like', '%' . $this->search . '%')
                ->where('company_id', $company_id)
                ->where('local_id', $local_id)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant); */

            // lista de comprobantes
            $query = Comprobante::select('id', 'serienumero', 'valorventa', 'totalimpuestos', 'mtoimpventa', 'currency_id', 'customer_id', 'tipocomprobante_id')
                ->where('serienumero', 'like', '%' . $this->search . '%')
                ->where('company_id', $company_id)
                ->where('local_id', $local_id);

            // Si el campo de orden es 'serienumero', usamos orden numérico correcto
            if ($this->sort === 'serienumero') {
                $query->orderByRaw('SUBSTRING_INDEX(serienumero, "-", 1) ' . $this->direction)
                    ->orderByRaw('CAST(SUBSTRING_INDEX(serienumero, "-", -1) AS UNSIGNED) ' . $this->direction);
            } else {
                // En cualquier otro campo, usa orderBy normal
                $query->orderBy($this->sort, $this->direction);
            }

            $comprobantes = $query->paginate($this->cant);
        } else {
            $comprobantes = [];
        }

        return view('livewire.admin.comprobante-list', compact('comprobantes'));
    }


    public function order($sort)
    {
        $this->resetPage();
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function llenartemporal($detalle)
    {
        foreach ($detalle as $item) {

            $mtovalorunitario = $item->price / (1 + ($this->igv * 0.01)); //actualizamos//precio de producto sin inc igv ejemplo 100

            Temporalnc::create([
                //'serienumero' => $item->comprobante->serienumero,
                'quantity' => $item->cant,
                'saleprice' => $item->price,
                'subtotal' => $item->subtotal,
                'product_id' => $item->product_id,
                'comprobante_id' => $item->comprobante_id,
                'company_id' => $item->company_id,
                'employee_id' => auth()->user()->employee->id,
                'codigobarras' => $item->codigobarras, //codigo del producto que necesita la facturacion electronica
                'igv' => $item->igv,
                'icbper' => $item->icbper,
                'totalimpuestos' => $item->totalimpuestos,
                'mtovalorunitario' => floatval($mtovalorunitario),
                'mtovalorventa' => floatval($item->mtovalorventa),
                'mtobaseigv' => floatval($item->mtobaseigv),
                'name' => $item->product->name,
                'um' => $item->product->um->abbreviation,
                'tipafeigv' => $item->product->tipoafectacion->codigo,
                'porcentajeigv' => $this->igv,  //igv lo tenemos en el mount es 18%
                'factoricbper' => $this->factoricbper,  //factoricbper lo tenemos en el mount es 0.2
            ]);
        }
    }

    public function generateXml(Comprobante $comprobante)
    {
        //dd($comprobante);
        //$temporals = Comprobante_Product::where('comprobante_id', $comprobante->id)->get();
        //obtenemos temporals para factura y boleta
        if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2) {
            //obtenemos temporal de factura y boleta
            $temporals = Temporal::where('company_id', auth()->user()->employee->company->id)
                ->where('employee_id', auth()->user()->employee->id)
                ->where('state', 1) //el state 1 indica que el comprobante esta en el temporal, para indicar que se guardo pero no se termino de enviar a sunat
                ->where('comprobante_id', $comprobante->id)->get(); //state 0 tiene los temporales actuales, 1 ya esta grabado pero no enviado a sunat
            //el state 0 indica que se mostrara al realizar el comprobante, el state 1 no se muestra pero esta en la tabla hasta que se envie a SUNAT
        } elseif ($comprobante->tipocomprobante_id == 3 or $comprobante->tipocomprobante_id == 5) {
            //el detalle se guardara en el teporal
            $detalle = Comprobante_Product::where('comprobante_id', $comprobante->id)
                ->where('company_id', auth()->user()->employee->company->id)->get(); //falta restringir para que solo ,uestre lo que le corresponde osea no de otro local ni de otra empresa
            $this->llenartemporal($detalle);
            //obtenemos temporal de nc factura y boleta
            $temporals = Temporalnc::where('company_id', auth()->user()->employee->company->id)
                ->where('employee_id', auth()->user()->employee->id)->get();
        }


        if ($comprobante->tipocomprobante_id == 1) { //si es factura
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->factura, null, null);
        } elseif ($comprobante->tipocomprobante_id == 2) { //si es boleta
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->boleta, null, null);
        } elseif ($comprobante->tipocomprobante_id == 3) { //si es ncfactura
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->ncfactura, null, null);
        } elseif ($comprobante->tipocomprobante_id == 5) { //si es ncboleta
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->ncboleta, null, null);
        }

        //dd($sunat);
        $sunat->getSee();

        if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2) {
            $sunat->setInvoice(); //setInvoice es el metodo de greenter
            $sunat->generateXml(); //generateXml es el metodo de greenter
            //no se elimina el temporal, pero state es 1.
        }

        if ($comprobante->tipocomprobante_id == 3 or $comprobante->tipocomprobante_id == 5) {
            $sunat->setNota(); //setNota es el metodo de greenter
            $sunat->generateXml(); //generateXml es el metodo de greenter
            $temporals->each->delete(); //eliminamos tempotal, porque en este caso se vuelve a generar
        }

        //$sunat->setInvoice();
        $this->emit('alert', 'El comprobante se creo y firmo correctamente, pero no se envio a SUNAT');
    }

    public function sendSunat(Comprobante $comprobante)
    {
        //si es factura o boleta genera temporal para ejecutar con setInvoice
        if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2) {
            $temporals = Temporal::where('company_id', auth()->user()->employee->company->id)
                ->where('employee_id', auth()->user()->employee->id)
                ->where('state', 1)
                ->where('comprobante_id', $comprobante->id)->get(); //state 0 tiene los temporales actuales, 1 ya esta grabado pero no enviado a sunat
        } elseif ($comprobante->tipocomprobante_id == 3 or $comprobante->tipocomprobante_id == 5) {
            //si es ncfactura o ncboleta genera temporal para ejecutar con setNota
            $detalle = Comprobante_Product::where('comprobante_id', $comprobante->id)
                ->where('company_id', auth()->user()->employee->company->id)->get(); //falta restringir para que solo ,uestre lo que le corresponde osea no de otro local ni de otra empresa

            $this->llenartemporal($detalle);

            $temporals = Temporalnc::where('company_id', auth()->user()->employee->company->id)
                ->where('employee_id', auth()->user()->employee->id)->get();
        }


        if ($comprobante->tipocomprobante_id == 1) { //si es factura
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->factura, null, null);
        } elseif ($comprobante->tipocomprobante_id == 2) { //si es boleta
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->boleta, null, null);
        } elseif ($comprobante->tipocomprobante_id == 3) { //si es ncfactura
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->ncfactura, null, null);
        } elseif ($comprobante->tipocomprobante_id == 5) { //si es ncboleta
            $sunat = new SunatService($comprobante, $this->company, $temporals, $comprobante->ncboleta, null, null);
        }

        $sunat->getSee();

        if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2) {
            $sunat->setInvoice();
        }
        if ($comprobante->tipocomprobante_id == 3 or $comprobante->tipocomprobante_id == 5) {
            $sunat->setNota();
        }

        $sunat->send();

        $temporals->each->delete(); //eliminamos del temporal porque ya se envio a Sunat
        $this->emit('alert', 'El comprobante se envio a sunat');
    }


    public function downloadXml($comprobanteId)
    {
        $comprobante = Comprobante::findOrFail($comprobanteId);
        $xmlPath = $comprobante->factura->xml_path ?? $comprobante->boleta->xml_path ?? $comprobante->ncfactura->xml_path ?? $comprobante->ncboleta->xml_path;

        if (!$xmlPath) {
            abort(404);
        }

        $fileContent = Storage::disk('s3')->get($xmlPath);
        $fileName = basename($xmlPath);

        return response()->streamDownload(function () use ($fileContent) {
            echo $fileContent;
        }, $fileName, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }



    /*     public function downloadxml($comprobanteId)
    {
        dd($comprobanteId);
        $comprobante = Comprobante::findOrFail($comprobanteId);
        $xmlPath = $comprobante->factura->xml_path ?? $comprobante->boleta->xml_path ?? $comprobante->ncfactura->xml_path ?? $comprobante->ncboleta->xml_path;

        if (!$xmlPath) {
            abort(404);
        }

        $fileContent = Storage::disk('s3')->get($xmlPath);
        $fileName = basename($xmlPath);

        return response()->streamDownload(function () use ($fileContent) {
            echo $fileContent;
        }, $fileName, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    } */
}
