<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoafectacionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipoafectacions')->delete();
        
        \DB::table('tipoafectacions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'codigo' => '10',
                'name' => 'Gravado - Operación Onerosa',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'codigo' => '11',
                'name' => 'Gravado – Retiro por premio',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'codigo' => '12',
                'name' => 'Gravado – Retiro por donación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}