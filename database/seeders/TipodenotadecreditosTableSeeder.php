<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipodenotadecreditosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipodenotadecreditos')->delete();
        
        \DB::table('tipodenotadecreditos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'codigo' => '01',
                'description' => 'Anulación de la operación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'codigo' => '02',
                'description' => 'Anulación por error en el RUC',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'codigo' => '03',
                'description' => 'Corrección por error en la descripción',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'codigo' => '04',
                'description' => 'Descuento global',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'codigo' => '05',
                'description' => 'Descuento por ítem',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'codigo' => '06',
                'description' => 'Devolución total',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'codigo' => '07',
                'description' => 'Devolución por ítem',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'codigo' => '08',
                'description' => 'Bonificación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'codigo' => '09',
                'description' => 'Disminución en el valor',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'codigo' => '10',
                'description' => 'Otros Conceptos',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'codigo' => '11',
                'description' => 'Ajustes de operaciones de exportación',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'codigo' => '12',
                'description' => 'Ajustes afectos al IVAP',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}