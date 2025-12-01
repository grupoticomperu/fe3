<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacturasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facturas')->delete();
        
        \DB::table('facturas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'serie' => 'F001',
                'numero' => 1,
                'serienumero' => 'F001-1',
                'fechaemision' => '2024-03-22 00:00:00',
                'fechavencimiento' => '2024-03-23 00:00:00',
                'total' => 177.0,
                'comprobante_id' => 1,
                'company_id' => 1,
                'paymenttype_id' => 1,
                'currency_id' => 1,
                'tipodecambio_id' => 1,
                'send_xml' => '1',
                'sunat_success' => '1',
                'sunat_error' => NULL,
                'hash' => 'tdlP/uMUOaAinkCTDVhJXxVBCcw=',
                'xml_path' => 'invoices/xml/20447393302-01-F001-1.xml',
                'pdf_path' => 'invoices/pdf/20447393302-01-F001-1.pdf',
                'sunat_cdr_path' => 'invoices/cdr/R-20447393302-01-F001-1.zip',
                'cdr_code' => '0',
                'cdr_notes' => NULL,
                'cdr_description' => 'La Factura numero F001-1, ha sido aceptada',
                'created_at' => '2024-03-22 23:38:12',
                'updated_at' => '2024-03-22 23:38:14',
            ),
            1 => 
            array (
                'id' => 2,
                'serie' => 'F001',
                'numero' => 2,
                'serienumero' => 'F001-2',
                'fechaemision' => '2024-03-22 00:00:00',
                'fechavencimiento' => '2024-03-23 00:00:00',
                'total' => 118.0,
                'comprobante_id' => 2,
                'company_id' => 1,
                'paymenttype_id' => 1,
                'currency_id' => 1,
                'tipodecambio_id' => 1,
                'send_xml' => '1',
                'sunat_success' => '1',
                'sunat_error' => NULL,
                'hash' => 'J8zT0ryvVj9QqG/nGMnFX+lHZt0=',
                'xml_path' => 'invoices/xml/20447393302-01-F001-2.xml',
                'pdf_path' => 'invoices/pdf/20447393302-01-F001-2.pdf',
                'sunat_cdr_path' => 'invoices/cdr/R-20447393302-01-F001-2.zip',
                'cdr_code' => '0',
                'cdr_notes' => NULL,
                'cdr_description' => 'La Factura numero F001-2, ha sido aceptada',
                'created_at' => '2024-03-22 23:39:26',
                'updated_at' => '2024-03-22 23:39:27',
            ),
        ));
        
        
    }
}