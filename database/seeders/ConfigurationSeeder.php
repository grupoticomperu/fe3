<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuration;
use Carbon\Carbon;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'logo' => 'public/logo/ticom.jpg',
            'razonsocial' => 'TICOM SRL',
            'ruc' => '20447393302',
            'certificado' => 'xxxx yyyy zzzz',
            'state' => 1,
            'fechainicio' => Carbon::now(),
            'fechafin' => Carbon::now()->addDays(30),
            'incluirigv' => 1,
            'nota1' => 'NOTA: Una vez realizado el pago, por favor sirvase a enviar el boucher de pago o constancia de transferencia, para poder confirmar y validar su deposito.',
            'nota2' => 'ESTE DOCUMENTO NO TIENE VALIDEZ TRIBUTARIO, ESTE DOCUMENTO ES INFORMATIVO PARA QUE PUEDAN VER LAS FECHAS DE FINALIZACIÓN DEL SERVICIO. TICOM EMITIRÁ UNA FACTURA ELECTRÓNICA UNA VEZ REALIZADO EL DEPÓSITO.',
            'nota3' => 'NOTA: Una vez realizado el pago, por favor sirvase a enviar el boucher de pago o constancia de transferencia, para poder confirmar y validar su deposito.',

            'numdecimalesproducto' => 8,
            'numdecimalescomprobante' => 2,

        ]);
    }
}
