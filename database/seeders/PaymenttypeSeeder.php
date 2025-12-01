<?php

namespace Database\Seeders;

use App\Models\Paymenttype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paymenttype::create([
            'name' => 'CONTADO',
        ]);

        Paymenttype::create([
            'name' => 'CREDITO',
        ]);

    }
}
