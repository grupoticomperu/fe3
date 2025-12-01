<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MotivotrasladosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('motivotraslados')->delete();
        
        \DB::table('motivotraslados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'codigo' => '01',
                'description' => 'Venta',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'codigo' => '14',
                'description' => 'Venta sujeta a confirmación del comprador',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'codigo' => '02',
                'description' => 'Compra',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'codigo' => '04',
                'description' => 'Traslado entre establecimientos de la misma empresa',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'codigo' => '18',
                'description' => 'Traslado emisor itinerante CP',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'codigo' => '08',
                'description' => 'Importación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'codigo' => '09',
                'description' => 'Exportación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'codigo' => '19',
                'description' => 'Traslado a zona primaria',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'codigo' => '13',
                'description' => 'Otros',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}