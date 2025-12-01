<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipodeoperacionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tipodeoperacions')->delete();

        \DB::table('tipodeoperacions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'codigo' => '0101',
                'descripcion' => 'Venta interna',
                'comprobantesafectados' => 'Factura, Boletas',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'codigo' => '0102',
                'descripcion' => 'Venta Interna – Anticipos',
                'comprobantesafectados' => 'Factura, Boletas',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'codigo' => '1001',
                'descripcion' => 'Venta Interna – Sujeto a Detracción',
                'comprobantesafectados' => 'Factura, Boletas',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
