<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransportistasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transportistas')->delete();
        
        \DB::table('transportistas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipodocumento_id' => 2,
                'numdoc' => '10133523',
                'nomrazonsocial' => 'mike cabello alvino',
                'address' => 'av peru 231',
                'nromtc' => '32324',
                'company_id' => 1,
                'predeterminado' => 0,
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'tipodocumento_id' => 4,
                'numdoc' => '20447393303',
                'nomrazonsocial' => 'ticomex',
                'address' => 'av peru 234',
                'nromtc' => '53443',
                'company_id' => 1,
                'predeterminado' => 0,
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}