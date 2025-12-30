<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NcboletadisenosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ncboletadisenos')->delete();
        
        \DB::table('ncboletadisenos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ncboleta',
                'nameblade' => 'admin.comprobante.ncboletadiseno1',
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