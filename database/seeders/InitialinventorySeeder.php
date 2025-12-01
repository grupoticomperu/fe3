<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Initialinventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InitialinventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Initialinventory::create([
            'name' => 'Local 1 inventario inicial',
            'datestart' => '2023-05-23',
            'local_id' => 1,
            'user_id' => 1,
        ]);

        Initialinventory::create([
            'name' => 'Local 2 inventario inicial',
            'datestart' => '2023-05-23',
            'local_id' => 2,
            'user_id' => 2,
        ]);


        Initialinventory::create([
            'name' => 'Local 3 inventario inicial',
            'datestart' => '2023-05-23',
            'local_id' => 3,
            'user_id' => 2,
        ]);


        Initialinventory::create([
            'name' => 'Local 4 inventario inicial',
            'datestart' => '2023-05-23',
            'local_id' => 4,
            'user_id' => 2,
        ]);



    }
}
