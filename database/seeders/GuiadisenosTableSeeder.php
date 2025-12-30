<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GuiadisenosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('guiadisenos')->delete();
        
        \DB::table('guiadisenos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'guia',
                'nameblade' => 'admin.comprobante.guiadiseno1',
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