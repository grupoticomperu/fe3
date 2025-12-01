<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComprobantesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comprobantes')->delete();
        
        \DB::table('comprobantes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'customer_id' => 3,
                'local_id' => 1,
                'tipocomprobante_id' => 1,
                'local_tipocomprobante_id' => 1,
                'company_id' => 1,
                'employee_id' => 1,
                'tipodeoperacion_id' => 1,
                'tipodocumento_id' => 4,
                'serienumero' => 'F001-1',
                'fechaemision' => '2024-03-22 00:00:00',
                'fechavencimiento' => '2024-03-23 00:00:00',
                'paymenttype_id' => 1,
                'currency_id' => 1,
                'mtoopergravadas' => 150.0,
                'mtooperexoneradas' => 0.0,
                'mtooperinafectas' => 0.0,
                'mtooperexportacion' => 0.0,
                'mtoopergratuitas' => 0.0,
                'mtoigv' => 27.0,
                'mtoigvgratuitas' => 0.0,
                'icbper' => 0.0,
                'totalimpuestos' => 27.0,
                'valorventa' => 150.0,
                'subtotal' => 177.0,
                'redondeo' => NULL,
                'mtoimpventa' => 177.0,
                'anticipos' => NULL,
                'detracciones' => NULL,
                'legends' => '[{"code":"1000","value":"CIENTO SETENTA Y SIETE CON 0000\\/100 "}]',
                'nota' => NULL,
                'created_at' => '2024-03-22 23:38:12',
                'updated_at' => '2024-03-22 23:38:12',
            ),
            1 => 
            array (
                'id' => 2,
                'customer_id' => 4,
                'local_id' => 1,
                'tipocomprobante_id' => 1,
                'local_tipocomprobante_id' => 1,
                'company_id' => 1,
                'employee_id' => 1,
                'tipodeoperacion_id' => 1,
                'tipodocumento_id' => 4,
                'serienumero' => 'F001-2',
                'fechaemision' => '2024-03-22 00:00:00',
                'fechavencimiento' => '2024-03-23 00:00:00',
                'paymenttype_id' => 1,
                'currency_id' => 1,
                'mtoopergravadas' => 100.0,
                'mtooperexoneradas' => 0.0,
                'mtooperinafectas' => 0.0,
                'mtooperexportacion' => 0.0,
                'mtoopergratuitas' => 0.0,
                'mtoigv' => 18.0,
                'mtoigvgratuitas' => 0.0,
                'icbper' => 0.0,
                'totalimpuestos' => 18.0,
                'valorventa' => 100.0,
                'subtotal' => 118.0,
                'redondeo' => NULL,
                'mtoimpventa' => 118.0,
                'anticipos' => NULL,
                'detracciones' => NULL,
                'legends' => '[{"code":"1000","value":"CIENTO DIECIOCHO CON 0000\\/100 "}]',
                'nota' => NULL,
                'created_at' => '2024-03-22 23:39:26',
                'updated_at' => '2024-03-22 23:39:26',
            ),
        ));
        
        
    }
}