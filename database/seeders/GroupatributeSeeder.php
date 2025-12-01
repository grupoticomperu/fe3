<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Groupatribute;

class GroupatributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Groupatribute::create([
            'name' => 'General',
            'state'=>1,
            'order'=>1,
        ]);

        Groupatribute::create([
            'name' => 'Tallas',
            'state'=>1,
            'order'=>2,
        ]);

        Groupatribute::create([
            'name' => 'Colores',
            'state'=>1,
            'order'=>3,
        ]);

        Groupatribute::create([
            'name' => 'Volumenes',
            'state'=>1,
            'order'=>4,
        ]);

        Groupatribute::create([
            'name' => 'Talla zapato',
            'state'=>1,
            'order'=>5,
        ]);

        Groupatribute::create([
            'name' => 'Tamaño',
            'state'=>1,
            'order'=>6,
        ]);


    }
}
