<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocalTipocomprobantesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('local_tipocomprobantes')->delete();

        \DB::table('local_tipocomprobantes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'serie' => 'F001',
                'inicio' => 1,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 1,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'serie' => 'B001',
                'inicio' => 20,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 2,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'serie' => 'FC01',
                'inicio' => 2,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 3,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'serie' => 'FD01',
                'inicio' => 2,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 4,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'serie' => 'BC01',
                'inicio' => 2,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 5,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'serie' => 'BD01',
                'inicio' => 2,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 6,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 7,
                'serie' => 'T001',
                'inicio' => 10,
                'default' => 1,
                'local_id' => 1,
                'tipocomprobante_id' => 7,
                'company_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
