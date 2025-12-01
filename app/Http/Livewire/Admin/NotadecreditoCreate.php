<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use App\Models\Impuesto;
use App\Models\Ncboleta;
use App\Models\Province;
use App\Models\Ncfactura;
use App\Models\Department;
use App\Models\Temporalnc;
use App\Models\Comprobante;
use App\Models\Comprobante_Product;
use App\Models\Tipodenotadecredito;
use App\Models\Local_tipocomprobante;
use Luecano\NumeroALetras\NumeroALetras;
use App\Services\SunatService;

class NotadecreditoCreate extends Component
{
    public $company;
    public $comprobante, $detalle, $igv, $factoricbper;

    public $mtoopergravadas, $mtooperexoneradas, $mtooperinafectas, $mtooperexportacion, $mtoopergratuitas, $mtoigv, $mtoigvgratuitas, $icbper, $totalimpuestos;
    public $valorventa, $subtotall, $mtoimpventa, $redondeo, $legends;
    public $total, $totalenletras;

    public $company_id;
    public $moneda;
    public $tipocomprobante_id; //si es NC Boleta, NC Factura
    public $tipocomprobante_namecorto;
    public $serie;
    public $numero;
    public $tipodenotadecredito_id = "";
    public $fechaemision;
    public $datosEliminados = false;
    public $tipodocumento_id;
    public $serienumero, $local_id, $ruc, $customer_id, $departamento = "LIMA", $provincia = "LIMA", $distrito = "LIMA";
    public $local_tipocomprobante_id;
    public $tipodocumentoafectado;
    public $serienumeroafectado;
    public $desmotivo, $currency_id, $nota;
    public $sending_method;


    protected $listeners = ['delete', 'limpiar'];

    public function mount(Comprobante $id)
    {
        $this->comprobante = $id; //$this->comprobante es el comprobante al cual se esta haciendo nota de credito
        if ($this->comprobante->tipocomprobante_id != 1 && $this->comprobante->tipocomprobante_id != 2) {
            abort(403, 'Sólo se hace NC a Facturas y Boletas.');
            return;
        }


        $this->company = auth()->user()->employee->company;
        $this->company_id = auth()->user()->employee->company->id; //compañia logueaada
        // $this->currency_id = auth()->user()->employee->company->currency_id; //$this->currency_id  hace que en la lista de currencies muestre por defecto soles por ejemplo
        $this->moneda = auth()->user()->employee->company->currency->abbreviation ?? 'Sol';
        $this->igv = Impuesto::where('siglas', 'IGV')->value('valor'); //es el 18%
        $this->factoricbper = Impuesto::where('siglas', 'ICBPER')->value('valor'); //es 0.2
        $this->currency_id = $this->comprobante->currency_id;

        $this->fechaemision = Carbon::now()->format('Y-m-d');
        $this->ruc = $this->comprobante->numdoc;
        $this->customer_id = $this->comprobante->customer_id;
        $this->tipodocumentoafectado = $this->comprobante->tipocomprobante->codigo; //01 fact electronica, 03 boleta electronica
        $this->serienumeroafectado = $this->comprobante->serienumero;
        $this->tipodocumento_id = $this->comprobante->tipodocumento_id;
        //$this->tipodenotadecredito_id


        //buscamos por company_id employee_id temporales guardados  y si encontramos lo eliminamos

        //serie
        // $this->tipocomprobante_id = $this->comprobante->tipocomprobante_id;
        $local = auth()->user()->employee->local;
        //dd($this->tc = $local->tipocomprobantes);  se obtiene la tabla tipocomprobantes pero que son de local logueado
        // Obtener la serie a través de la relación muchos a muchos
        switch ($this->comprobante->tipocomprobante_id) {
            case 1:
                $this->tipocomprobante_id = 3; //ncboleta=3 en la tabla tipocomprobantes
                $this->tipocomprobante_namecorto = "NC FACTURA";

                $this->serie = $local->tipocomprobantes
                    ->where('id', $this->tipocomprobante_id)
                    ->first()
                    ->pivot
                    ->serie ?? "null";


                $lastFactura = Ncfactura::where('company_id', $this->company_id)
                    ->where('serie', $this->serie)
                    ->latest('numero')
                    ->first();

                if ($lastFactura) {
                    $this->numero = $lastFactura->numero + 1;
                } else {
                    //busco en la tabla companies configuracion dende se puso el numero
                    $lastFactura = Local_tipocomprobante::where('company_id', $this->company_id)
                        ->where('serie', $this->serie)
                        ->where('local_id', auth()->user()->employee->local->id)
                        //->where('tipocomprobante_id', 3)
                        ->first();
                    if ($lastFactura)
                        $this->numero = $lastFactura->inicio;
                }
                break;

            case 2:
                $this->tipocomprobante_id = 5; //ncboleta=5 en la tabla tipocomprobantes
                $this->tipocomprobante_namecorto = "NC BOLETA";

                $this->serie = $local->tipocomprobantes
                    ->where('id', $this->tipocomprobante_id)
                    ->first()
                    ->pivot
                    ->serie ?? "null";

                $lastNcboleta = Ncboleta::where('company_id', $this->company_id)
                    ->where('serie', $this->serie)
                    ->latest('numero')
                    ->first();

                if ($lastNcboleta) {
                    $this->numero = $lastNcboleta->numero + 1;
                } else {
                    //busco en la tabla companies configuracion dende se puso el numero
                    $lastNcboleta = Local_tipocomprobante::where('company_id', $this->company_id)
                        ->where('serie', $this->serie)
                        ->where('local_id', auth()->user()->employee->local->id)
                        //->where('tipocomprobante_id', 3)
                        ->first();
                    if ($lastNcboleta)
                        $this->numero = $lastNcboleta->inicio;
                }
                break;
            default:
                break;
        }

        //$this->initialize($id);
        if (!$this->datosEliminados) {
            $this->datosEliminados = true;
            $this->company_id = auth()->user()->employee->company->id;
            $temporalnc = Temporalnc::where('company_id', $this->company_id)
                ->where('employee_id', auth()->user()->employee->id)->get();

            /* Temporalnc::where('company_id', $this->company_id)
                ->where('employee_id', auth()->user()->employee->id)->delete(); */
            if ($temporalnc->isNotEmpty()) {
                $temporalnc->each->delete();
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




    //guardamos el comprobante
    public function save()
    {


        $this->validate([
            'tipodenotadecredito_id' => 'required|integer|exists:tipodenotadecreditos,id',
            'desmotivo' => 'required|string|max:255',
            'fechaemision' => 'required|date',
        ], [
            'tipodenotadecredito_id.required' => 'Debe seleccionar un tipo de nota de crédito.',
            'tipodenotadecredito_id.integer' => 'El tipo de nota de crédito debe ser válido.',
            'tipodenotadecredito_id.exists' => 'El tipo de nota de crédito seleccionado no existe.',
            'desmotivo.required' => 'Debe ingresar el motivo de la nota de crédito.',
            'desmotivo.string' => 'El motivo debe ser texto.',
            'fechaemision.required' => 'Debe ingresar la fecha de emisión.',
        ]);


        //$this->tipocomprobante_id = "07";// nota de credito
        // Validación de que la fecha de vencimiento sea mayor o igual a la fecha de emisión
        $this->local_id = auth()->user()->employee->local->id;
        //factura. boleta
        $this->local_tipocomprobante_id = Local_tipocomprobante::where('local_id', $this->local_id)->where('tipocomprobante_id', $this->tipocomprobante_id)->value('id');

        $this->serienumero = $this->serie . "-" . $this->numero;
        //dd($this->serienumero);
        //Los datos del cliente yaestan guardados
        // $this->validate();
        //guadamos la tabla comprobantes se crea el comprobante de la NC
        $comprobante = Comprobante::create([
            'customer_id' => $this->customer_id,
            'local_id' => $this->local_id,
            'tipocomprobante_id' => $this->tipocomprobante_id, //NC NOTa de credito
            'local_tipocomprobante_id' => $this->local_tipocomprobante_id, ///////////////////averiguar que es
            'company_id' => auth()->user()->employee->company->id, //encontramos la company actual osea la compania del usuario logueado
            'employee_id' => auth()->user()->employee->id,
            //'tipodeoperacion_id' => $this->tipodeoperacion_id, //venta interna en este caso ponemos 0101, pero em la tabla tiene id = 1
            'tipodocumento_id' => $this->tipodocumento_id, //ruc, dni el $this->tipodocumento_id es 4 pero su codigo es 6
            'fechaemision' =>  $this->fechaemision,
            //'fechavencimiento' =>  $this->fechavencimiento,
            //'paymenttype_id' => $this->paymenttype_id, //contado, credito
            'currency_id' => $this->currency_id, //PEN, USD $this->currency_id =1

            'mtoopergravadas' => $this->mtoopergravadas,
            'mtooperexoneradas' => $this->mtooperexoneradas,
            'mtooperinafectas' => $this->mtooperinafectas,
            'mtooperexportacion' => $this->mtooperexportacion,
            'mtoopergratuitas' => $this->mtoopergratuitas,
            'mtoigv' => $this->mtoigv,
            'mtoigvgratuitas' => $this->mtoigvgratuitas,
            'icbper' => $this->icbper,
            'totalimpuestos' => $this->totalimpuestos,
            'valorventa' => $this->valorventa,
            'subtotal' => $this->subtotall,
            'mtoimpventa' => $this->mtoimpventa,
            'redondeo' => $this->redondeo,
            'legends' => json_encode($this->getLegends()),
            'serienumero' => $this->serienumero,
            //'legends' => json_encode($this->legends),
            //anticipos
            //detracciones
            'nota' => $this->nota,
        ]);

        //guardamos de acuerdo al comprobante escogido, boleta, factura

        //si loescogido es 1(dni), 4, 6(ruc)
        switch ($this->tipocomprobante_namecorto) {

            case 'NC FACTURA':
                //es NC factura guardamos en la tabla ncfacturas, se guardara en la variable $boleta indepenientemente si es factura, nc,guia, etc
                $boleta = Ncfactura::create([
                    'serie' => $this->serie,
                    'numero' => $this->numero,
                    'serienumero' => $this->serienumero,
                    'fechaemision' =>  $this->fechaemision,
                    //'tipocomprobante_id' => $this->tipocomprobante_id, //NC NOTa de credito es el tipo de documento afectado
                    'tipodocumentoafectado' => $this->tipodocumentoafectado, //factura o boleta
                    'numdocumentoafectado' => $this->serienumeroafectado,
                    'tipodenotadecredito_id' => $this->tipodenotadecredito_id, //esto es el codigo del motivo, codmotivo
                    'desmotivo' => $this->desmotivo,
                    'total' => $this->total,
                    'comprobante_id' => $comprobante->id,
                    'company_id' => auth()->user()->employee->company->id,
                    'currency_id' => $this->currency_id,
                    'tipodecambio_id' => 1, //1 es un codigo de la tabla tipo de cambios es el id
                ]);
                break;
            case 'NC BOLETA':
                //es NC boleta, guadamos en la tabla ncboletas
                $boleta = Ncboleta::create([
                    'serie' => $this->serie,
                    'numero' => $this->numero,
                    'serienumero' => $this->serienumero,
                    'fechaemision' =>  $this->fechaemision,
                    'tipodocumentoafectado' => $this->tipodocumentoafectado, //factura o boleta
                    'numdocumentoafectado' => $this->serienumeroafectado,
                    'tipodenotadecredito_id' => $this->tipodenotadecredito_id, //esto es el codigo del motivo, codmotivo
                    'desmotivo' => $this->desmotivo,
                    'total' => $this->total,
                    'comprobante_id' => $comprobante->id,
                    'company_id' => auth()->user()->employee->company->id,
                    'currency_id' => $this->currency_id,
                    'tipodecambio_id' => 1, //1 es un codigo de la tabla tipo de cambios es el id
                ]);
                break;
            default:
                break;
        }
        //guardamos en $temporals todo lo que se va gravar en la tabla comprobante_product
        $temporals = Temporalnc::where('company_id', auth()->user()->employee->company->id)
            ->where('employee_id', auth()->user()->employee->id)->get();
        //guardamos el detalle de la nota de credito
        foreach ($temporals as $temporal) {
            Comprobante_Product::create([
                'cant' => $temporal->quantity,
                'price' => $temporal->saleprice,
                'subtotal' => $temporal->subtotal,
                'product_id' => $temporal->product_id,
                'comprobante_id' => $comprobante->id,
                'company_id' => $this->company_id,
                'codigobarras' => $temporal->codigobarras, //codigo del producto que necesita la facturacion electronica
                'mtobaseigv' => $temporal->mtobaseigv,
                'igv' => $temporal->igv,
                'icbper' => $temporal->icbper,
                'totalimpuestos' => $temporal->totalimpuestos,
                'mtovalorventa' => $temporal->mtovalorventa,
            ]);
        }
        //facturacion electronica
        //$boleta es la ncfactura o ncBoleta que se genero
        $sunat = new SunatService($comprobante, $this->company, $temporals, $boleta, null, null);

        $see = $sunat->getSee();
        $note = $sunat->setNota();

        switch ($this->sending_method) {
            case '1':
                $sunat->send(); //send es el metodo de greenter
                $temporals->each->delete(); //eliminamos temporal
                $this->emit('alert', 'La Nota de Crédito se creo correctamente y se envio a sunat');
                break;
            case '2':
                $sunat->generateXml(); ////send es el meto de greenter
                $temporals->each->delete(); //eliminamos temporal
                $this->emit('alert', 'El comprobante se creo y firmo correctamente, pero no se envio a SUNAT');
                break;
            case '3':
                //La factura se guardo pero no se envio a sunat
                $temporals->each->delete(); //eliminamos temporal
                $this->emit('alert', 'El comprobante se creo, pero no se firmo ni envio a SUNAT');
                break;
        }

        ///$sunat->generatePdfReport();

        /* $result = $sunat->send();
        $sunat->generatePdfReport();
        $sunat->generateXml();
        $temporals->each->delete(); */
        /* $xml = $this->see->getFactory()->getLastXml();
        $this->invoice['xml'] = $this->see->getFactory()->getLastXml();
        $this->invoice['hash'] = (new XmlUtils())->getHashSign($xml);
        dd($this->invoice); */

        //$this->emitTo('admin.comprobante-list', 'render');

        $this->emit('alert', 'El comprobante se creo correctamente');

        return redirect()->route('admin.comprobante.list');






        //eliminar el temporal


        //enviar mensaje de guardado


    }


    /* public function initialize(Comprobante $id)
    {
        $this->comprobante = $id;

        $this->company_id = auth()->user()->employee->company->id;
        $temporalnc = Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)->get();
        if($temporalnc->isNotEmpty())
        {
            $temporalnc->each->delete();
        }
        $detalle = Comprobante_Product::where('comprobante_id', $this->comprobante->id)->get(); //falta restringir para que solo ,uestre lo que le corresponde osea no de otro local ni de otra empresa

        $this->llenartemporal($detalle);
    } */







    public function delete($temporal)
    {
        //$this->authorize('update', $brand);
        Temporalnc::where('product_id', $temporal)->delete();
        //$temporal->delete();
        $this->total = $this->getTotalFromTemporals();
        //agregue esto para actualizar parametros
        $this->getTotales();
        //debemos limiar el array invoive
    }


    public function removeItem($id)
    {
        $registro = Temporalnc::find($id);
        if ($registro) {
            // Si se encontró el modelo, eliminarlo
            $registro->delete();
            $this->total = $this->getTotalFromTemporals();
        }
    }

    // actualizar cantidad item en carrito
    public function updateQty($id, $saleprice, $quantity = 1, $mtovalorunitario)
    {
        $this->datosEliminados = true;
        //dd($id);
        if ($quantity <= 0) {
            $this->removeItem($id);
        } else {
            $this->updateQuantity($id, $saleprice, $quantity, $mtovalorunitario);
        }
    }


    //pasaremos parametros desde la vista
    public function updateQuantity($id, $saleprice, $quantity, $mtovalorunitario)
    {
        //dd($id);

        $subtotal = floatval($quantity) * floatval($saleprice);

        $mtovalorunitario = $saleprice / (1 + ($this->igv * 0.01));


        //$this->subtotall = $quantity * $saleprice;
        ////////////////////////////////////////
        //// debo actualizar en temporal  las variables que usan cantidades /////
        /////////////////////////////////////

        if ($saleprice > 0 and $quantity > 0) {

            $productelegido = Temporalnc::where('product_id', $id)->first();
            $productelegido->update([
                'quantity' => floatval($quantity),
                'subtotal' => floatval($subtotal),
                'mtobaseigv' => floatval($quantity) * floatval($mtovalorunitario), //cantidad * precio sin igv
                'igv' => $subtotal - (floatval($quantity) * floatval($mtovalorunitario)), //es 118 -100= 18soles
                'icbper' => $quantity * $this->factoricbper,
                'totalimpuestos' => $quantity * $this->factoricbper + ($subtotal - (floatval($quantity) * floatval($mtovalorunitario))),
                'mtovalorventa' => floatval($quantity) * floatval($mtovalorunitario), //subtotal sin inc IGV ejemplo 100 x 2 = 200

            ]);
        }

        $this->total = $this->getTotalFromTemporals();
        //agregue esto para actualizar parametros
        $this->getTotales();
    }


    public function updatePrice($id, $saleprice, $quantity)
    {
        $subtotal = $quantity * $saleprice;
        $mtovalorunitario = $saleprice / (1 + ($this->igv * 0.01)); //actualizamos//precio de producto sin inc igv ejemplo 100
        $mtobaseigv = $quantity * $mtovalorunitario; //cantidad * precio sin igv
        $igv = $subtotal - ($quantity * $mtovalorunitario); //es 118 -100= 18soles
        $totalimpuestos = $quantity * $this->factoricbper + ($subtotal - ($quantity * $mtovalorunitario));
        $mtovalorventa = $mtovalorunitario * $quantity; //subtotal sin inc IGV ejemplo 100 x 2 = 200

        //se cambio el precio, cambiara precio sin igv, el igv y el subtotal
        if ($saleprice > 0 and $quantity > 0) {
            $productelegido = Temporalnc::where('product_id', $id)->first();
            $productelegido->update([
                'saleprice' => $saleprice,
                'subtotal' => $subtotal,
                'mtovalorunitario' => $mtovalorunitario,
                'mtobaseigv' => $mtobaseigv,
                'igv' => $igv,
                'totalimpuestos' => $totalimpuestos,
                'mtovalorventa' => $mtovalorventa, //subtotal sin inc IGV ejemplo 100 x 2 = 200
            ]);
        }


        $this->total = $this->getTotalFromTemporals();
        //agregue esto para actualizar parametros
        $this->getTotales();
    }

    public function getTotales()
    {

        $this->mtoopergravadas = Temporalnc::where('company_id', $this->company_id) //tambien deberiamos poner where('local_id')
            ->where('employee_id', auth()->user()->employee->id)
            ->where('tipafeigv', '10')
            ->sum('mtovalorventa'); //$mtovalorventa = $mtovalorunitario * $newQuantity;//es el subtotal sin inc IGV ejemplo 100 x 2 = 200


        $this->mtooperexoneradas = Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->where('tipafeigv', '20')
            ->sum('mtovalorventa'); // mtovalorventa  es precio sin igv X quantity

        $this->mtooperinafectas =  Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->where('tipafeigv', '30')
            ->sum('mtovalorventa'); //$mtovalorventa = $mtovalorunitario * $Quantity

        $this->mtooperexportacion =  Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->where('tipafeigv', '40')
            ->sum('mtovalorventa');

        $this->mtoopergratuitas =  Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->whereNotIn('tipafeigv', ['10', '20', '30', '40'])
            ->sum('mtovalorventa');

        $this->mtoigv =  Temporalnc::where('company_id', $this->company_id) //es la suma de todos los igv
            ->where('employee_id', auth()->user()->employee->id)
            ->whereIn('tipafeigv', ['10', '20', '30', '40'])
            ->sum('igv'); // es la suma de los IGV ejemplo 18 + 9 +180

        $this->mtoigvgratuitas =  Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->whereNotIn('tipafeigv', ['10', '20', '30', '40'])
            ->sum('igv');



        $this->icbper =  Temporalnc::where('company_id', $this->company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->where('esbolsa', 1)
            ->sum('icbper');

        $this->totalimpuestos = number_format($this->mtoigv + $this->icbper, 4); //formatea a 4 decimales si tiene 6 dcimales solo muestra 4 pero no redondea para redondear debemos usar round

        $this->valorventa =  Temporalnc::where('company_id', $this->company_id) //es el total sin inc igv ejemplo 100x2= 200 soles
            ->where('employee_id', auth()->user()->employee->id)
            ->whereIn('tipafeigv', ['10', '20', '30', '40'])
            ->sum('mtovalorventa'); //$mtovalorventa = $mtovalorunitario * $Quantity  ejemplo 100 x 2

        $this->valorventa = floatval($this->valorventa);
        $this->totalimpuestos = floatval($this->totalimpuestos);

        $this->subtotall = number_format($this->valorventa + $this->totalimpuestos, 4); // $this->valorventa es la suma de todos los  mtovalorventa de cada registro que esta en temporal

        //$this->mtoimpventa = floor($this->subtotall * 10) / 10;
        $this->mtoimpventa = floatval($this->subtotall);

        //$this->redondeo = $this->subtotall - $this->mtoimpventa;


    }

    public function getLegends()
    {
        $formatter = new NumeroALetras();

        $this->legends = [];

        $this->legends[] = [
            'code' => '1000',
            'value' => $formatter->toInvoice($this->subtotall, 4)
        ];



        /* if (collect($this->invoice['details'])->whereNotIn('tipAfeIgv', ['10', '20', '30', '40'])->count()) {
            $legends[] = [
                'code' => '1002',
                'value' => 'TRANSFERENCIA GRATUITA DE UN BIEN Y/O SERVICIO PRESTADO GRATUITAMENTE'
            ];
        } */

        /*  if ($this->tipodeoperacion_codigo == '1001' &&  $this->subtotall > $this->company->detraccion) {
            $this->legends[] = [
                'code' => '2006',
                'value' => 'Operación sujeta a detracción'
            ];
        } */

        // $this->invoice['legends'] = $legends;
        return $this->legends;
    }


    public function getTotalFromTemporals()
    {
        $formatter = new NumeroALetras();
        //cambiar por this->company_id
        $company_id = auth()->user()->employee->company->id;

        // Obtener el total de la tabla temporals para la empresa actual
        $this->total = Temporalnc::where('company_id', $company_id)
            ->where('employee_id', auth()->user()->employee->id)
            ->sum('subtotal');


        //$this->totalenletras = $formatter->toInvoice($this->subtotall, 4);
        //$this->totalenletras = $formatter->toInvoice($this->mtoimpventa, 2);
        $this->totalenletras = $formatter->toInvoice($this->total, 2);

        return $this->total; //esto controla la vista del carrito
        //return $this->totalenletras;
    }



    public function render()
    {
        $this->getTotales();
        $this->getLegends();

        $tipodenotadecreditos = Tipodenotadecredito::all();

        $this->total = $this->getTotalFromTemporals();

        $cart = Temporalnc::all();

        return view('livewire.admin.notadecredito-create', compact('cart', 'tipodenotadecreditos'));
    }
}
