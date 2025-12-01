<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            'name' => 'Impuesto General a las ventas',    
            'abbreviation' => 'IGV', 
            'value' => 18.00, 
            'state' => 1,
        ]);

        Tax::create([
            'name' => 'Detracción',    
            'abbreviation' => 'DETRACCIÓN', 
            'value' => 12.00, 
            'state' => 1,
        ]);

        Tax::create([
            'name' => 'Retención',    
            'abbreviation' => 'RETENCIÓN', 
            'value' => 2.00, 
            'state' => 1,
        ]);

        Tax::create([
            'name' => 'Impuesto a la Bolsa',    
            'abbreviation' => 'ICB', 
            'value' => 0.5, 
            'state' => 1,
        ]);
    }
}
