<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImpuestosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('impuestos')->delete();
        
        \DB::table('impuestos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Impuesto General a las Ventas',
                'valor' => 18.0,
                'siglas' => 'IGV',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'icbper',
                'valor' => 0.2,
                'siglas' => 'ICBPER',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}