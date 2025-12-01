<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ctacte;

class CtacteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ctacte::create([
            'bank' => 'BANCO DE CREDITO',    
            'number' => '191-1351-623 -1 -74', 
            'cci' => '2044 191-1351-623 -1 -74', 
            'holder' => 'TICOM SRL', 
            'description' => 'Cta cte en soles', 
            'state' => 1,
            'currency_id' => 1,
            
        ]);
                
        Ctacte::create([
            'bank' => 'BANCO DE CREDITO',    
            'number' => '191-11460-602 -1 -74', 
            'cci' => '2044 191-1351-623 -1 -74', 
            'holder' => 'TICOM SRL', 
            'description' => 'Cta cte en dolares', 
            'state' => 1,
            'currency_id' => 2,
            
        ]);
    }
}
