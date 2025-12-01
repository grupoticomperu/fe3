<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymenttypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('paymenttypes')->delete();
        
        \DB::table('paymenttypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'contado',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'credito',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}