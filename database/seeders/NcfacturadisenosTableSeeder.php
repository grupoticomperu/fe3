<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NcfacturadisenosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ncfacturadisenos')->delete();
        
        \DB::table('ncfacturadisenos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ncfactura',
                'nameblade' => 'admin.comprobante.ncfacturadiseno1',
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