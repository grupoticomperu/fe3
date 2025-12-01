<?php

namespace App\Services;

use DateTime;
use Greenter\See; //importar
use Greenter\Model\Sale\Note;
use Greenter\Report\XmlUtils;
use Greenter\Report\PdfReport;
use Greenter\Model\Sale\Legend;
use Greenter\Report\HtmlReport;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Despatch\Driver;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Despatch\Vehicle;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Direction;
use Illuminate\Support\Facades\Storage;
use App\Models\Company as ModelsCompany;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Report\Resolver\DefaultTemplateResolver;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\Log;

class SunatService
{
    public $comprobante, $company, $temporals, $boleta;
    public $api;
    public $see;
    public $voucher;
    public $result;
    public $dispach;
    public $total, $totalenletras;


    public function __construct($comprobante, $company, $temporals, $boleta, $total, $totalenletras)
    {
        //$boleta  puede ser factura, boleta, ncfactura, ncboleta
        $this->comprobante = $comprobante;
        $this->company = $company;
        $this->temporals = $temporals; //los temporales de factura y boleta es el mismo, el temporal de nota de credito es otra
        $this->boleta = $boleta; //loque se guardo es ncfactura o ncboleta

        $this->total = $total;
        $this->totalenletras = $totalenletras;
        // $this->boletas = $boletas;

        //dd($this->company->certificate_path);
        //dd(Storage::disk('s3')->exists($this->company->certificate_path));
        /*  try {
            $content = Storage::disk('s3')->get('fe/TICOM/certificados/t2ET55ZXrAegoFN2KsG22nA3qOaUo6wtX6teSdRA.txt');
            dd('OK ✅', substr($content, 0, 200)); // solo los primeros 200 caracteres
        } catch (\Exception $e) {
            dd('Error ❌', $e->getMessage());
        } */
    }

    public function getSee()
    {
        // configuraremos el certificado digital, la ruta del servicio y las credenciales (Clave SOL) a utilizar:
        /* $see = new See();
        $see->setCertificate(Storage::get($this->company->certificate_path)); //le pasamos la ruta del certificado, da como resultado el contenido del certificado
        $see->setService($this->company->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA); //le indicamos si es beta o produccion
        $see->setClaveSOL($this->company->ruc, $this->company->soluser, $this->company->solpass); //le pasamos los datos de la clave sol usurio secundario
        return $see; //retornamos todos los valores */
        $endpoint = $this->company->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA;

        $this->see = new See();

        // $path = public_path('storage/public/certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem');

        /* dd([
            'exists' => Storage::exists("certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem"),
            'path' => storage_path('app/certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem'),
            'content' => substr(Storage::get("certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem"), 0, 100),
        ]); */


        //file_get_contents(public_path('certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem'));
        $this->see->setCertificate(Storage::get("certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem"));




        //$this->see->setCertificate(Storage::disk('s3')->get($this->company->certificate_path));
        //Storage::disk('s3')->url($logoback)
        $this->see->setService($endpoint);
        $this->see->setClaveSOL($this->company->ruc, $this->company->soluser, $this->company->solpass);
    }

    //para envio de guias, se envia con un api, esta es la conexión
    public function getSeeApi($company)
    {

        /* if (!Storage::exists('certificates/certificate_1.pem')) {
            throw new \Exception('Certificate file not found');
        } */

        $this->api = new \Greenter\Api($company->production ? [

            'auth' => 'https://api-seguridad.sunat.gob.pe/v1',
            'cpe' => 'https://api-cpe.sunat.gob.pe/v1',

        ] : [

            'auth' => 'https://gre-test.nubefact.com/v1',
            'cpe' => 'https://gre-test.nubefact.com/v1',

        ]);

        $this->api->setBuilderOptions([
            'strict_variables' => true,
            'optimizations' => 0,
            'debug' => true,
            'cache' => false,
        ])->setApiCredentials(
            $company->production ? $company->cliente_id : "test-85e5b0ae-255c-4891-a595-0b98c65c9854", //client_id
            $company->production ? $company->cliente_secret : "test-Hty/M6QshYvPgItX2P0+Kw==" //client_secreT
        )->setClaveSOL(
            $company->ruc,
            $company->production ? $company->sol_user : "MODDATOS",
            $company->production ? $company->sol_pass : "MODDATOS"
            //)->setCertificate(Storage::get($company->cert_path));
        )->setCertificate(Storage::get("certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem"));
        //$this->see->setCertificate(Storage::get("certificates/LLAMAPECERTIFICADODEMO20447393302_cert_out.pem"));

        // return $this->api;
    }


    //Despatch
    public function setDespatch()
    {
        $this->voucher = (new Despatch())
            ->setVersion('2022')
            ->setTipoDoc('09')
            ->setSerie($this->boleta->serie)
            ->setCorrelativo($this->boleta->numero)
            ->setFechaEmision(new \DateTime($this->boleta->fechaemision))
            ->setCompany($this->getCompany())
            ->setDestinatario($this->getDestinatario())
            ->setEnvio($this->getEnvio())
            ->setDetails($this->getDespatchDetails());
    }


    public function sendDespatch()
    {
        $this->result = $this->api->send($this->voucher);
        //$this->dispach = $this->api->send($this->voucher);
        //dd($this->result);
        $this->boleta->send_xml = true;
        $this->boleta->sunat_success = $this->result->isSuccess();
        //$this->boleta->sunat_success = $this->dispach->isSuccess();
        //$this->boleta->save();

        // Guardar XML firmado digitalmente.
        $xml = $this->api->getLastXml();
        $this->boleta->hash = (new XmlUtils())->getHashSign($xml);
        //$this->boleta->xml_path = 'guides/xml/' . $this->voucher->getName() . '.xml';
        //Storage::put($this->boleta->xml_path, $xml, 'public');

        //// $this->boleta->xml_path = 'fe/' . $this->company->razonsocial . '/guides/xml/' . $this->voucher->getName() . '.xml';
        //// Storage::disk('s3')->put($this->boleta->xml_path, $xml, 'public');



        $docName = $this->buildCpeName();

        // XML de la guía
        $this->boleta->xml_path = 'fe/' . $this->company->razonsocial . '/guides/xml/' . $docName . '.xml';
        Storage::disk('s3')->put($this->boleta->xml_path, $xml, 'public');




        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$this->boleta->sunat_success) {

            $this->boleta->sunat_error = [
                'code' => $this->result->getError()->getCode(),
                'message' => $this->result->getError()->getMessage()
            ];
            $this->boleta->save();

            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Codigo Error: ' . $this->boleta->sunat_error['code'],
                'text' => $this->boleta->sunat_error['message']
            ]);

            return;
        }

        //Ticket
        $ticket = $this->result->getTicket();
        //dd($ticket);
        $this->result = $this->api->getStatus($ticket);
  


        $cdrZip = $this->result->getCdrZip();
        if ($cdrZip !== null) {
            //$this->boleta->sunat_cdr_path = "guides/cdr/R-{$this->voucher->getName()}.zip";
            //Storage::put($this->boleta->sunat_cdr_path, $cdrZip, 'public');
            /* $docName = $this->buildCpeName(); */

            $this->boleta->sunat_cdr_path = 'fe/' . $this->company->razonsocial . '/guides/cdr/R-' . $this->voucher->getName() . '.zip';
            Storage::disk('s3')->put($this->boleta->sunat_cdr_path, $cdrZip, 'public');

            $this->boleta->save();

        }

    
        //Lectura del CDR
        //$this->readCdr();
    }





    /* public function getDespatchDetails($details)
    {
        $green_details = [];

        foreach ($details as $detail) {
            $green_details[] = (new DespatchDetail)
                ->setCantidad($detail['cantidad'] ?? null)
                ->setUnidad($detail['unidad'] ?? null)
                ->setDescripcion($detail['descripcion'] ?? null)
                ->setCodigo($detail['codigo'] ?? null);
        }

        return $green_details;
    } */

    public function getDespatchDetails()
    {
        $details = [];

        foreach ($this->temporals as $item) {
            $details[] = (new DespatchDetail())
                ->setCantidad($item->quantity)
                ->setUnidad($item->um)
                ->setDescripcion($item->name)
                ->setCodigo($item->codigobarras);
        }

        return $details;
    }



    //método para generar guias
    public function getDestinatario()
    {

        //$address = new Address();
        //$address->setDireccion($this->boleta->customer->address);

        return (new Client())
            ->setTipoDoc($this->boleta->customer->tipodocumento->codigo)
            ->setNumDoc($this->boleta->customer->numdoc)
            ->setRznSocial($this->boleta->customer->nomrazonsocial)
            ->setAddress(
                (new Address())
                    ->setDireccion($this->boleta->customer->address)
            );
    }

    public function getEnvio()
    {
        $shipment = (new Shipment)
            ->setCodTraslado($this->boleta->motivotraslado->codigo) //saca del catalogo 20 de sunat ver https://cpe.sunat.gob.pe/sites/default/files/inline-files/anexoV-340-2017.pdf
            ->setModTraslado($this->boleta->modalidaddetraslado) //saca del catalogo 18  ($this->boleta->modalidaddetraslado
            ->setFecTraslado(new \DateTime($this->boleta->fechadetraslado))
            //->setFechaEmision(new \DateTime($this->boleta->fechaemision))
            ->setPesoTotal($this->boleta->pesototal)
            ->setUndPesoTotal('KGM') //$this->boleta->um->abbreviation
            ->setLlegada(new Direction($this->boleta->ubigeollegada, $this->boleta->direccionllegada))
            ->setPartida(new Direction($this->boleta->puntodepartida->ubigeo, $this->boleta->puntodepartida->direccion));



        if ($this->boleta->modalidaddetraslado == '01') { //publico
            $shipment->setTransportista($this->getTransportista());
        }

        if ($this->boleta->modalidaddetraslado == '02') { //privado
            $shipment->setVehiculo($this->getVehiculo())
                ->setChoferes($this->getChoferes());
        }

        //dd($shipment);

        return $shipment;
    }


    public function getTransportista()
    {
        //con dni no manda
        return (new Transportist())
            ->setTipoDoc($this->boleta->transportista->tipodocumento->codigo)
            ->setNumDoc($this->boleta->transportista->numdoc)
            ->setRznSocial($this->boleta->transportista->nomrazonsocial)
            ->setNroMtc($this->boleta->transportista->nromtc);
    }


    public function getVehiculo()
    {
        $vehiculos = $this->boleta->vehiculos;

        $secundarios = [];

        foreach ($vehiculos->slice(1) as $item) {
            $secundarios[] = (new Vehicle())
                ->setPlaca($item->numeroplaca);
        }

        return (new Vehicle())
            ->setPlaca($vehiculos->first()->numeroplaca)
            ->setSecundarios($secundarios);

        /* [
            [
                'placa' => 'A1B-123',
            ],
            [
                'placa' => 'A1B-123',
            ],
            [
                'placa' => 'A1B-123',
            ]
        ] */

        /* $vehiculo = (new Vehicle())
                    ->setPlaca($data['placa'] ?? null);

           $vehiculoSecundario = (new Vehicle())
                    ->setPlaca($data['placaSecundaria'] ?? null);

           $vehiculo->getSecundarios([$vehiculoSecundario]); */
    }


    public function getChoferes()
    {
        //$choferes = collect($choferes);
        $choferes = $this->boleta->conductors;
        $drivers = [];

        $drivers[] = (new Driver())
            ->setTipo('Principal')
            ->setTipoDoc($choferes->first()->tipodocumento->codigo) //https://www.sunat.gob.pe/legislacion/superin/2014/anexo8-300-2014.pdf    en el catalogo 6
            ->setNroDoc($choferes->first()->numdoc)
            ->setLicencia($choferes->first()->licencia)
            ->setNombres($choferes->first()->nomape)
            ->setApellidos($choferes->first()->nomape);

        foreach ($choferes->slice(1) as $item) //->slice(1) toma todos los valores excepto el primero(1) si fuera slice(2) no toma el 2
        {
            $drivers[] = (new Driver)
                ->setTipo('Secundario')
                ->setTipoDoc($item->tipodocumento->codigo)
                ->setNroDoc($item->numdoc)
                ->setLicencia($item->licencia)
                ->setNombres($item->nomape)
                ->setApellidos($item->nomape);
        }

        return $drivers;
    }



    //este método es para factura y boleta
    public function setInvoice()
    {
        $this->voucher = (new Invoice())
            ->setUblVersion('2.1')
            ->setTipoOperacion($this->comprobante->tipodeoperacion->codigo) // Venta - Catalog. 51
            ->setTipoDoc($this->comprobante->tipocomprobante->codigo) // Factura - Catalog. 01, factura 01, boleta 03

            ->setSerie($this->boleta->serie)
            ->setCorrelativo($this->boleta->numero) // Zona horaria: Lima
            //->setFechaEmision($this->invoice['fechaEmision']) // Zona horaria: Lima
            ->setFechaEmision(new \DateTime($this->boleta->fechaemision)) //creo es en minusculaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
            ->setTipoMoneda($this->boleta->currency->name) // Sol - Catalog. 02
            ->setCompany($this->getCompany())
            ->setClient($this->getClient())

            //MtoOper
            ->setMtoOperGravadas($this->comprobante->mtoopergravadas)
            ->setMtoOperExoneradas($this->comprobante->mtooperexoneradas)
            ->setMtoOperInafectas($this->comprobante->mtooperinafectas)
            ->setMtoOperExportacion($this->comprobante->mtooperexportacion)
            ->setMtoOperGratuitas($this->comprobante->mtoopergratuitas)

            //Impuestos
            ->setMtoIGV($this->comprobante->mtoigv) //todo los igv
            ->setMtoIGVGratuitas($this->comprobante->mtoigvgratuitas)
            ->setIcbper($this->comprobante->icbper)
            ->setTotalImpuestos($this->comprobante->totalimpuestos)

            //Totales
            ->setValorVenta($this->comprobante->valorventa)
            ->setSubTotal($this->comprobante->subtotal)
            ->setRedondeo($this->comprobante->redondeo)
            ->setMtoImpVenta($this->comprobante->mtoimpventa)

            //Productos
            ->setDetails($this->getSaleDetails())

            //Leyendas
            ->setLegends($this->getLegends());
    }

    //este metodo es para nota de credito ncfactura y ncboleta
    public function setNota()
    {
        //dd($this->boleta);
        $this->voucher = (new Note())
            ->setUblVersion('2.1')
            //->setTipoOperacion($this->comprobante->tipodeoperacion->codigo) // Venta - Catalog. 51
            ->setTipoDoc($this->comprobante->tipocomprobante->codigo) // nota de credito "07" , factura 01, boleta 03  Catalog. 01
            ->setSerie($this->boleta->serie) //de la nota de credito
            ->setCorrelativo($this->boleta->numero) // de la nota de credito
            //->setFechaEmision($this->invoice['fechaEmision']) // Zona horaria: Lima
            ->setFechaEmision(new \DateTime($this->boleta->fechaemision))
            ->setTipDocAfectado($this->boleta->tipodocumentoafectado) //01 factura o 03 boleta del cual estamos haciendo la nc
            //->setTipDocAfectado('01') // si esta afectando a una factura o boleta los valores 01 y 03
            ->setNumDocfectado($this->boleta->numdocumentoafectado) //numero del comprobante del cual estamos haciendo la nc
            //->setCodMotivo('01')
            ->setCodMotivo($this->boleta->tipodenotadecredito->codigo) //tipo de nota de cretito es la tabla de sunat: por anulacion, error, etc valores 01 , 02
            ->setDesMotivo($this->boleta->desmotivo) //descripcion del motivo del tipo de nota de credito
            //->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
            ->setTipoMoneda($this->boleta->currency->name)
            //->setTipoMoneda('PEN') // Sol - Catalog. 02
            ->setCompany($this->getCompany())
            ->setClient($this->getClient())

            //MtoOper
            ->setMtoOperGravadas($this->comprobante->mtoopergravadas)
            ->setMtoOperExoneradas($this->comprobante->mtooperexoneradas)
            ->setMtoOperInafectas($this->comprobante->mtooperinafectas)
            ->setMtoOperExportacion($this->comprobante->mtooperexportacion)
            ->setMtoOperGratuitas($this->comprobante->mtoopergratuitas)

            //Impuestos
            ->setMtoIGV($this->comprobante->mtoigv) //todo los igv
            ->setMtoIGVGratuitas($this->comprobante->mtoigvgratuitas)
            ->setIcbper($this->comprobante->icbper)
            ->setTotalImpuestos($this->comprobante->totalimpuestos)

            //Totales
            ->setValorVenta($this->comprobante->valorventa)
            ->setSubTotal($this->comprobante->subtotal)
            ->setRedondeo($this->comprobante->redondeo)
            ->setMtoImpVenta($this->comprobante->mtoimpventa)

            //Productos
            ->setDetails($this->getSaleDetails())

            //Leyendas
            ->setLegends($this->getLegends());
    }


    public function getClient()
    {
        return (new Client())
            ->setTipoDoc($this->comprobante->tipodocumento->codigo)
            ->setNumDoc($this->comprobante->customer->numdoc)
            ->setRznSocial($this->comprobante->customer->nomrazonsocial)
            ->setAddress(
                (new Address())
                    ->setDireccion($this->comprobante->customer->address)
            );
    }

    public function getCompany()
    {
        return (new Company())
            ->setRuc($this->company->ruc)
            ->setRazonSocial($this->company->razonsocial)
            ->setNombreComercial($this->company->nombrecomercial)
            ->setAddress(
                (new Address())
                    ->setUbigueo($this->company->ubigeo)
                    ->setDepartamento("Lima")
                    ->setProvincia("Lima")
                    ->setDistrito("Lima")
                    ->setUrbanizacion($this->company->urbanizacion)
                    ->setDireccion($this->company->direccion)
            );
    }

    public function getSaleDetails()
    {
        $details = [];

        foreach ($this->temporals as $item) {

            $details[] = (new SaleDetail())
                ->setCodProducto($item->codigobarras)
                ->setUnidad('NIU') //->setUnidad($item->um)
                ->setDescripcion($item->name)
                ->setCantidad($item->quantity)
                ->setMtoValorGratuito($item->mtovalorgratuito)
                ->setMtoValorUnitario($item->mtovalorunitario) //precio unitario sin igv
                ->setMtoBaseIgv($item->mtobaseigv) // precio unitario sin igv * cantidad
                ->setPorcentajeIgv($item->porcentajeigv) //18%
                ->setIgv($item->igv) //igv por item
                ->setFactorIcbper($item->factoricbper) //como el igv es 18% , aqui es 0.2
                ->setIcbper($item->icbper) //cantidad * factoricbper
                ->setTipAfeIgv($item->tipafeigv)
                ->setTotalImpuestos($item->totalimpuestos)
                //->setTotalImpuestos($item->igv)//esto esta monentaneo
                ->setMtoValorVenta($item->mtovalorventa) //cantidad * precio unitario sin igv
                ->setMtoPrecioUnitario($item->saleprice); //mtoPrecioUnitario es el sale price
        }

        return $details;
    }


    public function getLegends()
    {
        //codigo de la leyenda y su descripción
        //un comprobante puede tener varias letendas
        $legends = [];

        // Decodificar el JSON para obtener un array asociativo
        $legendsArray = json_decode($this->comprobante->legends, true);

        if ($legendsArray !== null) {
            foreach ($legendsArray as $legend) {
                // Crear objetos Legend y agregarlos al array
                $legends[] = (new Legend())
                    ->setCode($legend['code']) // Catalog. 52
                    ->setValue($legend['value']);
            }
        }

        return $legends;
    }


    //Enviar a Sunat
    public function send()
    {
        //dd($this->voucher);
        //dd($this->result);//no hay result por eso falla
        $this->result = $this->see->send($this->voucher);
        //dd($this->result);
        $this->boleta->send_xml = true;
        $this->boleta->sunat_success = $this->result->isSuccess();
        //dd($this->result->isSuccess());
        //dd($this->voucher);
        $this->boleta->save();
        //dd($this->boleta);
        // Guardar XML firmado digitalmente.
        $xml = $this->see->getFactory()->getLastXml();
        $this->boleta->hash = (new XmlUtils())->getHashSign($xml);

        /* $this->boleta->xml_path = 'invoices/xml/' . $this->voucher->getName() . '.xml';
        Storage::put($this->boleta->xml_path, $xml, 'public'); //esto funciona en local */


        $this->boleta->xml_path = 'fe/' . $this->company->razonsocial . '/invoices/xml/' . $this->voucher->getName() . '.xml';
        Storage::disk('s3')->put($this->boleta->xml_path, $xml, 'public');



        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$this->boleta->sunat_success) {
            $this->boleta->sunat_error = [
                'code' => $this->result->getError()->getCode(),
                'message' => $this->result->getError()->getMessage()
            ];
            $this->boleta->save();
            /*  session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Codigo Error: ' . $this->boleta->sunat_error['code'],
                'text' => $this->boleta->sunat_error['message']
            ]); */
            return;
        }
        // Guardamos el CDR
        /* $this->boleta->sunat_cdr_path = "invoices/cdr/R-{$this->voucher->getName()}.zip";
        Storage::put($this->boleta->sunat_cdr_path, $this->result->getCdrZip(), 'public');//funciona bien en local */

        $this->boleta->sunat_cdr_path = 'fe/' . $this->company->razonsocial . '/guides/cdr/R-' . $this->voucher->getName() . '.zip';
        Storage::disk('s3')->put($this->boleta->sunat_cdr_path, $this->result->getCdrZip(), 'public');

        $this->boleta->save();

        //Lectura del CDR
        //$this->readCdr();
    }


    //Lectura del CDR
    public function readCdr()
    {
        $cdr = $this->result->getCdrResponse();

        $this->boleta->cdr_code = (int)$cdr->getCode();
        $this->boleta->cdr_notes = count($cdr->getNotes()) ? $cdr->getNotes() : null;
        $this->boleta->cdr_description = $cdr->getDescription();

        $this->boleta->save();

        if ($this->boleta->cdr_code === 0) {

            /*  session()->flash('flash.sweetAlert', [
                'icon' => 'success',
                'title' => 'ESTADO: ACEPTADA',
                'text' => $this->boleta->cdr_notes ? 'OBSERVACIONES: ' . implode(', ', $cdr->getNotes()) : null,
                'footer' => $this->boleta->cdr_description,
            ]); */
        } else if ($this->boleta->cdr_code >= 2000 && $this->boleta->cdr_code <= 3999) {

            /* session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'ESTADO: RECHAZADA',
                'footer' => $this->boleta->cdr_description,
            ]); */
        } else {
            /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
            /*code: 0100 a 1999 */
            /*  session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Excepción',
                'footer' => $this->boleta->cdr_description,
            ]); */
        }
    }



    public function generatePdfReport()
    {
        $htmlReport = new HtmlReport(resource_path('views/sunat/template'), ['strict_variables' => true]);
        $htmlReport->setTemplate((new DefaultTemplateResolver())->getTemplate($this->voucher));

        $report = new PdfReport($htmlReport);
        $report->setOptions([
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);
        $report->setBinPath(env('WKHTMLTOPDF_PATH')); // Ruta al binario wkhtmltopdf

        // --------------------------------------------------
        // 🔹 BLOQUE ROBUSTO PARA CARGAR EL LOGO
        // --------------------------------------------------
        $logoContent = '';

        try {
            if ($this->company->logo) {
                // Verifica si el logo existe en S3
                if (Storage::disk('s3')->exists($this->company->logo)) {
                    $logoContent = Storage::disk('s3')->get($this->company->logo);
                }
                // O si existe en el disco 'public' (modo local)
                elseif (Storage::disk('public')->exists($this->company->logo)) {
                    $logoContent = Storage::disk('public')->get($this->company->logo);
                }
            }
        } catch (\Throwable $e) {
            \Log::warning('No se pudo obtener el logo desde almacenamiento: ' . $e->getMessage());
        }

        // Si no hay logo, usar uno por defecto desde public/
        if (empty($logoContent)) {
            $fallbackLogo = public_path('images/logo/logo.png');
            if (file_exists($fallbackLogo)) {
                $logoContent = file_get_contents($fallbackLogo);
            } else {
                $logoContent = ''; // evita null
            }
        }

        // --------------------------------------------------
        // 🔹 PARÁMETROS PARA EL TEMPLATE
        // --------------------------------------------------
        $params = [
            'system' => [
                'logo' => $logoContent,
                'hash' => $this->boleta->hash ?? '',
            ],
            'user' => [
                'header' => "Telf: <b>{$this->company->phone}</b>",
                'extras' => [
                    ['name' => 'CONDICIÓN DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'GITHUB SELLER'],
                ],
                'footer' => '<p>Nro Resolución: <b>3232323</b></p>',
            ],
        ];

        // --------------------------------------------------
        // 🔹 GENERACIÓN DEL PDF
        // --------------------------------------------------
        $pdf = $report->render($this->voucher, $params);

        try {
            $pdf = $report->render($this->voucher, $params);

            if (!$pdf) {
                dd([
                    'status' => '❌ No se generó el PDF',
                    'voucher_class' => get_class($this->voucher),
                    'voucher_name' => method_exists($this->voucher, 'getName') ? $this->voucher->getName() : null,
                    'has_hash' => !empty($this->boleta->hash),
                    'logo_length' => strlen($params['system']['logo'] ?? ''),
                ]);
            }

            $this->boleta->pdf_path = 'fe/' . $this->company->id . '/invoices/pdf/' . $this->voucher->getName() . '.pdf';
            Storage::disk('s3')->put($this->boleta->pdf_path, $pdf, 'public');
            $this->boleta->save();

            dd(['✅ PDF generado correctamente', 'path' => $this->boleta->pdf_path]);
        } catch (\Throwable $e) {
            dd([
                '❌ Error al generar PDF' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }




    public function generatePdfReportback()
    {

        $htmlReport = new HtmlReport(resource_path('views/sunat/template'), ['strict_variables' => true]);
        $htmlReport->setTemplate((new DefaultTemplateResolver())->getTemplate($this->voucher));
        //$htmlReport->setTemplate('ticket.html.twig');

        $report = new PdfReport($htmlReport);
        $report->setOptions([
            'no-outline',
            'viewport-size' => '1280x1024',
            //'page-width' => '8cm',
            //'page-height' => '20cm',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);
        $report->setBinPath(env('WKHTMLTOPDF_PATH')); // Ruta relativa o absoluta de wkhtmltopdf

        $params = [
            'system' => [
                'logo' => $this->company->logo ? Storage::disk('s3')->get($this->company->logo) : file_get_contents('images/logo/logo.png'), // Logo de Empresa
                //'logo' => $this->company->logo ? file_get_contents(public_path($this->company->logo)) : file_get_contents('images/logo/logo.png'), // Logo de Empresa
                'hash' => $this->boleta->hash, // Valor Resumen
            ],
            'user' => [
                'header'     => "Telf: <b>{$this->company->phone}</b>", // Texto que se ubica debajo de la dirección de empresa
                'extras'     => [
                    // Leyendas adicionales
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'GITHUB SELLER'],
                ],
                'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
            ]
        ];

        $pdf = $report->render($this->voucher, $params);


        if ($pdf) {
            //$this->boleta->pdf_path = 'invoices/pdf/' . $this->voucher->getName() . '.pdf';
            //Storage::put($this->boleta->pdf_path, $pdf, 'public');
            $this->boleta->pdf_path = 'fe/' . $this->company->id . '/invoices/pdf/' . $this->voucher->getName() . '.pdf';
            Storage::disk('s3')->put($this->boleta->pdf_path, $pdf, 'public');


            $this->boleta->save();
        }
    }


    public function generatePdfReport2($templateName)
    {
        $htmlReport = new HtmlReport(resource_path('views/sunat/template'), ['strict_variables' => true]);
        $htmlReport->setTemplate((new DefaultTemplateResolver())->getTemplate($templateName)); // Utiliza el nombre de la plantilla proporcionado

        $report = new PdfReport($htmlReport);
        $report->setOptions([
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);
        $report->setBinPath(env('WKHTMLTOPDF_PATH')); // Ruta relativa o absoluta de wkhtmltopdf

        $params = [
            'system' => [
                'logo' => $this->company->rectangle_image_path ? Storage::get($this->company->rectangle_image_path) : file_get_contents('img/logos/logo.png'), // Logo de Empresa
                'hash' => $this->boleta->hash, // Valor Resumen
            ],
            'user' => [
                'header'     => "Telf: <b>{$this->company->phone}</b>", // Texto que se ubica debajo de la dirección de empresa
                'extras'     => [
                    // Leyendas adicionales
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'GITHUB SELLER'],
                ],
                'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
            ]
        ];

        $pdf = $report->render($templateName, $params);

        if ($pdf) {
            $this->boleta->pdf_path = 'invoices/pdf/' . $templateName . '.pdf'; // Utiliza el nombre de la plantilla para el nombre del archivo PDF
            Storage::put($this->boleta->pdf_path, $pdf, 'public');

            $this->boleta->save();
        }
    }




    public function generatePdfReport3()
    {
        /* $params = [
            'system' => [
                'logo' => $this->company->logo ? Storage::disk('s3')->get($this->company->logo) : file_get_contents('images/logo/logo.png'),
                'hash' => $this->boleta->hash,
            ],
            'user' => [
                'header'     => "Telf: <b>{$this->company->phone}</b>",
                'extras'     => [
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'GITHUB SELLER'],
                ],
                'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
            ]
        ]; */

        // Renderizar la vista con los parámetros
        //$html = view('admin.comprobante.sunat_template', ['voucher' => $this->voucher, 'params' => $params])->render();
        $html = view('admin.comprobante.boletareports', ['company' => $this->company, 'comprobante' => $this->comprobante, 'boleta' => $this->boleta, 'temporals' => $this->temporals, 'total' => $this->total, 'totalenletras' => $this->totalenletras])->render();


        // Generar el PDF utilizando Dompdf
        $pdf = Pdf::loadHTML($html);

        // Opciones de configuración del PDF
        // $pdf->setPaper('A4', 'portrait');
        $pdf->setPaper([0, 0, 212.625, 9999], 'portrait');




        // Guardar el PDF en S3
        $pdfContent = $pdf->output();
        $this->boleta->pdf_path = 'fe/' . $this->company->razonsocial . '/invoices/pdf/' . $this->voucher->getName() . '.pdf';
        Storage::disk('s3')->put($this->boleta->pdf_path, $pdfContent, 'public');

        // Guardar la ruta en la base de datos
        $this->boleta->save();
    }










    //Generar XML
    public function generateXmlBack()
    {
        $xml = $this->see->getXmlSigned($this->voucher);
        $this->boleta->hash = (new XmlUtils())->getHashSign($xml);
        //$this->boleta->xml_path = 'invoices/xml/' . $this->voucher->getName() . '.xml';
        //Storage::put($this->boleta->xml_path, $xml, 'public');
        $this->boleta->xml_path = 'fe/' . $this->company->razonsocial . '/invoices/xml/' . $this->voucher->getName() . '.xml';
        Storage::disk('s3')->put($this->boleta->xml_path, $xml, 'public');
        $this->boleta->save();
    }





    public function generateXml()
    {
        try {
            // 🔹 Generar XML firmado correctamente con Greenter
            $xml = $this->see->getXmlSigned($this->voucher);

            // 🔹 Si por alguna razón no existe el XML firmado, intentamos obtener el último generado
            if (!$xml) {
                $xml = $this->see->getFactory()->getLastXml();
            }

            if (!$xml) {
                throw new \Exception('No se pudo generar el XML firmado.');
            }

            // 🔹 Calculamos el hash del XML
            $this->boleta->hash = (new XmlUtils())->getHashSign($xml);

            // 🔹 Construimos la ruta limpia para S3
            $path = 'fe/' . $this->company->razonsocial . '/invoices/xml/' . $this->voucher->getName() . '.xml';

            // 🔹 Guardamos el XML en S3
            Storage::disk('s3')->put($path, $xml, 'public');

            // 🔹 Guardamos en la BD
            $this->boleta->xml_path = $path;
            $this->boleta->save();

            // 🔹 Retornamos la URL completa (útil si quieres guardarla o mostrarla)
            return Storage::disk('s3')->url($path);
        } catch (\Throwable $e) {
            \Log::error('Error al generar XML en SunatService: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            throw new \Exception('No se pudo generar o subir el XML al S3. ' . $e->getMessage());
        }
    }




    public function resumen() {}



    private function buildCpeName(): string
    {
        // Evita depender de getName(), usa los datos actuales del voucher
        return "{$this->company->ruc}-{$this->voucher->getTipoDoc()}-{$this->voucher->getSerie()}-{$this->voucher->getCorrelativo()}";
    }
}
