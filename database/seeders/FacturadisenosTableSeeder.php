<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacturadisenosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facturadisenos')->delete();
        
        \DB::table('facturadisenos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'factura1',
                'nameblade' => 'admin.comprobante.facturadiseno1',
                'image1' => NULL,
                'image2' => NULL,
                'state' => 1,
                'order' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Factura diseno con logo',
                'nameblade' => 'admin.comprobante.facturadiseno2',
                'image1' => NULL,
                'image2' => NULL,
                'state' => 1,
                'order' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'factura diseno sin bordes',
                'nameblade' => 'admin.comprobante.facturadiseno3',
                'image1' => NULL,
                'image2' => NULL,
                'state' => 1,
                'order' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'factura diseno sin borde y logo',
                'nameblade' => 'admin.comprobante.facturadiseno4',
                'image1' => NULL,
                'image2' => NULL,
                'state' => 1,
                'order' => NULL,
                'description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}