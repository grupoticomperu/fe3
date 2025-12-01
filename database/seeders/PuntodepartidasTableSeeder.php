<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PuntodepartidasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('puntodepartidas')->delete();
        
        \DB::table('puntodepartidas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'direccion' => 'av javier prado 123',
                'department_id' => '15',
                'province_id' => '1501',
                'district_id' => '150101',
                'ubigeo' => '150101',
                'predeterminado' => 0,
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'direccion' => 'av petit thouars 234',
                'department_id' => '15',
                'province_id' => '1501',
                'district_id' => '150101',
                'ubigeo' => '150101',
                'predeterminado' => 0,
                'state' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}