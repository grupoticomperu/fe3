<?php

namespace Database\Seeders;

use App\Models\Atribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Atribute::create([
            'name' => 'Gral',
            'state'=>1,
            'order'=>1,
            'groupatribute_id'=>1
        ]);

        Atribute::create([
            'name' => 'S',
            'state'=>1,
            'order'=>1,
            'groupatribute_id'=>2
        ]);

        Atribute::create([
            'name' => 'M',
            'state'=>1,
            'order'=>2,
            'groupatribute_id'=>2
        ]);

        Atribute::create([
            'name' => 'L',
            'state'=>1,
            'order'=>3,
            'groupatribute_id'=>2
        ]);

        Atribute::create([
            'name' => 'XL',
            'state'=>1,
            'order'=>4,
            'groupatribute_id'=>2
        ]);


        Atribute::create([
            'name' => 'Rojo',
            'state'=>1,
            'order'=>5,
            'groupatribute_id'=>3
        ]);

        Atribute::create([
            'name' => 'Verde',
            'state'=>1,
            'order'=>6,
            'groupatribute_id'=>3
        ]);

        Atribute::create([
            'name' => 'Azul',
            'state'=>1,
            'order'=>7,
            'groupatribute_id'=>3
        ]);

        Atribute::create([
            'name' => 'Blanco',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>3
        ]);


        Atribute::create([
            'name' => '100m3',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>4
        ]);

        Atribute::create([
            'name' => '200m3',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>4
        ]);

        Atribute::create([
            'name' => '300m3',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>4
        ]);


        Atribute::create([
            'name' => '28',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>5
        ]);

        Atribute::create([
            'name' => '30',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>5
        ]);

        Atribute::create([
            'name' => '32',
            'state'=>1,
            'order'=>8,
            'groupatribute_id'=>5
        ]);

        Atribute::create([
            'name' => 'lata chica',
            'state'=>1,
            'order'=>9,
            'groupatribute_id'=>6
        ]);


        Atribute::create([
            'name' => 'lata grande',
            'state'=>1,
            'order'=>10,
            'groupatribute_id'=>6
        ]);




    }
}
