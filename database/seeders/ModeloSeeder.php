<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modelo;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelo::create([
            'name' => 'Modelo Venecia',    
            'slug'=>'modelo-venecia',
            'state' => 1,           
        ]);

        Modelo::create([
            'name' => 'Modelo Flor',  
            'slug'=>'modelo-flor',  
            'state' => 1,           
        ]);

        Modelo::create([
            'name' => 'Modelo Laydy', 
            'slug'=>'modelo-laydy',   
            'state' => 1,           
        ]);

        Modelo::create([
            'name' => 'Modelo Estrella',  
            'slug'=>'modelo-estrella', 
            'state' => 1,           
        ]);

        Modelo::create([
            'name' => 'Modelo Django', 
            'slug'=>'modelo-django',   
            'state' => 1,           
        ]);

        Modelo::create([
            'name' => 'Modelo Polar',    
            'slug'=>'modelo-polar',
            'state' => 1,           
        ]);
    }
}
