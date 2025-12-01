<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Local_tipocomprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local_tipocomprobante::create([
            'serie' => 'F01',
            'inicio' => 1000,
            'default' => 1,
            'local_id' => 1,
            'tipocomprobante_id' => 1,
        ]);
    }
}
