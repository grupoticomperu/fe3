<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComprobanteProductoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comprobante_producto')->delete();
        
        \DB::table('comprobante_producto')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cant' => 1.0,
                'price' => 118.0,
                'subtotal' => 118.0,
                'product_id' => 1,
                'comprobante_id' => 1,
                'company_id' => 1,
                'codigobarras' => '1b',
                'mtobaseigv' => 100.0,
                'igv' => 18.0,
                'icbper' => 0.0,
                'totalimpuestos' => 18.0,
                'mtovalorventa' => 100.0,
                'created_at' => '2024-03-22 23:38:12',
                'updated_at' => '2024-03-22 23:38:12',
            ),
            1 => 
            array (
                'id' => 2,
                'cant' => 1.0,
                'price' => 59.0,
                'subtotal' => 59.0,
                'product_id' => 2,
                'comprobante_id' => 1,
                'company_id' => 1,
                'codigobarras' => '2b',
                'mtobaseigv' => 50.0,
                'igv' => 9.0,
                'icbper' => 0.0,
                'totalimpuestos' => 9.0,
                'mtovalorventa' => 50.0,
                'created_at' => '2024-03-22 23:38:12',
                'updated_at' => '2024-03-22 23:38:12',
            ),
            2 => 
            array (
                'id' => 3,
                'cant' => 1.0,
                'price' => 118.0,
                'subtotal' => 118.0,
                'product_id' => 1,
                'comprobante_id' => 2,
                'company_id' => 1,
                'codigobarras' => '1b',
                'mtobaseigv' => 100.0,
                'igv' => 18.0,
                'icbper' => 0.0,
                'totalimpuestos' => 18.0,
                'mtovalorventa' => 100.0,
                'created_at' => '2024-03-22 23:39:26',
                'updated_at' => '2024-03-22 23:39:26',
            ),
        ));
        
        
    }
}