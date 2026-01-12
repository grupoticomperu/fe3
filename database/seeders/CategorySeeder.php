<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'Bolsa',
            'slug' => Str::slug('bolsa'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Bolsa',
            'parent_id'=> NULL,
            'company_id'=> 1,

        ]);

        $category1 = Category::create([
            'name' => 'Ropas',
            'slug' => Str::slug('ropas'),
            'state'=>1,
            'depth'=>0,
            'path' => 'ropas',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);



        Category::create([
            'name' => 'Computo',
            'slug' => Str::slug('computo'),
            'state'=>1,
            'depth'=>0,
            'path' => 'Computo',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Mobiles',
            'slug' => Str::slug('mobiles'),
            'state'=>1,
            'depth'=>0,
            'path' => 'Mobiles',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Niñas',
            'slug' => Str::slug('Niñas'),
            'state'=>1,
            'depth'=>0,
            'path' => 'Niñas',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Cereales',
            'slug' => Str::slug('Cereales'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Cereales',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Lacteos',
            'slug' => Str::slug('Lacteos'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Lacteos',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Refrescos',
            'slug' => Str::slug('Refrescos'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Refrescos',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Licores',
            'slug' => Str::slug('Licores'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Licores',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'Muebles',
            'slug' => Str::slug('muebles'),
            'state'=>0,
            'depth'=>0,
            'path' => 'Muebles',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);


        Category::create([
            'name' => 'sacos de polipropileno',
            'slug' => Str::slug('sacos de polipropileno'),
            'state'=>0,
            'depth'=>0,
            'path' => 'sacos de polipropileno',
            'parent_id'=> NULL,
            'company_id'=> 1,
        ]);


        Category::create([
            'name' => 'calzones',
            'slug' => Str::slug('calzones'),
            'state'=>0,
            'depth'=>1,
            'path' => 'Damas/calzones',
            'parent_id'=> 2,
            'company_id'=> 1,
        ]);

        Category::create([
            'name' => 'faldas',
            'slug' => Str::slug('faldas'),
            'state'=>0,
            'depth'=>1,
            'path' => 'Damas/faldas',
            'parent_id'=> 2,
            'company_id'=> 1,
        ]);



    }
}
