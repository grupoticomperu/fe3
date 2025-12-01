<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConductorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('conductors')->delete();

        \DB::table('conductors')->insert(array (
            0 =>
            array (
                'id' => 1,
                'tipodocumento_id' => 2,
                'numdoc' => '10133423',
                'nomape' => 'Michael Cabello Alvino',
                'licencia' => 'N10133423',
                'celular' => '996959784',
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'tipodocumento_id' => 2,
                'numdoc' => '10121547',
                'nomape' => 'Miguel de Hunamuno',
                'licencia' => 'N10121547',
                'celular' => '996929478',
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
