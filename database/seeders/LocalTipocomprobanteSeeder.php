<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Local_tipocomprobante;

class LocalTipocomprobanteSeeder extends Seeder
{

    public function run()
    {
        Local_tipocomprobante::create([
            'serie' => 'F01',
            'inicio' => 1000,
            'default' => 1,
            'local_id' => 1,
            'tipocomprobante_id' => 1,
        ]);

       /*  Local_tipocomprobante::create([
            'serie' => 'B01',
            'inicio' => 500,
            'default' => 0,
            'local_id' => 1,
            'tipocomprobante_id' => 2,
        ]);

        Local_tipocomprobante::create([
            'serie' => 'F02',
            'inicio' => 100,
            'default' => 1,
            'local_id' => 2,
            'tipocomprobante_id' => 1,
        ]);

        Local_tipocomprobante::create([
            'serie' => 'B02',
            'inicio' => 50,
            'default' => 0,
            'local_id' => 2,
            'tipocomprobante_id' => 2,
        ]); */
    }
}
