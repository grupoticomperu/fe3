<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Um;

class UmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Um::create([
            'name' => 'unidades',
            'abbreviation' => 'NIU',
            'state' => 1,
        ]);


        Um::create([
            'name' => 'docena',
            'abbreviation' => 'DOC',
            'state' => 1,
        ]);

        Um::create([
            'name' => 'ciento',
            'abbreviation' => 'CIEN',
            'state' => 1,
        ]);

        Um::create([
            'name' => 'metros',
            'abbreviation' => 'MTS',
            'state' => 1,
        ]);

    }
}
