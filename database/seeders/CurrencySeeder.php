<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'PEN',
            'abbreviation' => 'S/',
            'principal' => 'si',
            'state' => 1,
            //'company_id' => 1

        ]);

        Currency::create([
            'name' => 'USD',
            'abbreviation' => 'USD',
            //'default' => 0,
            'state' => 1,
            //'company_id' => 1

        ]);
    }
}
