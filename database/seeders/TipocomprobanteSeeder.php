<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipocomprobante;

class TipocomprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipocomprobante::create([
            'codigo' => '01',
            'name' => 'FACTURA ELECTRONICA',
            'namecorto' => 'FACTURA',
            'state' => 1,
        ]);

        Tipocomprobante::create([
            'codigo' => '03',
            'name' => 'BOLETA ELECTRONICA',
            'namecorto' => 'BOLETA',
            'state' => 1,
        ]);


        Tipocomprobante::create([
            'codigo' => '07',
            'name' => 'NOTA DE CREDITO FACTURA',
            'namecorto' => 'NC FACTURA',
            'state' => 1,
        ]);

        Tipocomprobante::create([
            'codigo' => '08',
            'name' => 'NOTA DE DEBITO FACTURA',
            'namecorto' => 'ND FACTURA',
            'state' => 1,
        ]);

        Tipocomprobante::create([
            'codigo' => '07',
            'name' => 'NOTA DE CREDITO BOLETA',
            'namecorto' => 'NC BOLETA',
            'state' => 1,
        ]);

        Tipocomprobante::create([
            'codigo' => '08',
            'name' => 'NOTA DE DEBITO BOLETA',
            'namecorto' => 'ND BOLETA',
            'state' => 1,
        ]);

        Tipocomprobante::create([
            'codigo' => '09',
            'name' => 'GUIA DE REMISIÓN',
            'namecorto' => 'GUIA',
            'state' => 1,
        ]);

    }
}
