<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehiculosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('vehiculos')->delete();

        \DB::table('vehiculos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'numeroplaca' => 'CAV034',
                'modelo' => 'nveo',
                'marca' => 'chevrolet',
                'tuce' => '564e5',
                'predeterminado' => 0,
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'numeroplaca' => 'B2A525',
                'modelo' => 'cruze',
                'marca' => 'chevrolet',
                'tuce' => '543566',
                'predeterminado' => 0,
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
