<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'name' => 'General',
            'slug' => Str::slug('General'),
            'state'=>0,
            'category_id'=>1
        ]);

        Subcategory::create([
            'name' => 'bluzas',
            'slug' => Str::slug('bluzas'),
            'state'=>1,
            'category_id'=>2
        ]);
        Subcategory::create([
            'name' => 'Zapatos',
            'slug' => Str::slug('Zapatos'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'snikers',
            'slug' => Str::slug('snikers'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'zandalias',
            'slug' => Str::slug('zandalias'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'polos',
            'slug' => Str::slug('polos'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'faldas',
            'slug' => Str::slug('faldas'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'pantalon',
            'slug' => Str::slug('pantalon'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'brazieres',
            'slug' => Str::slug('brazieres'),
            'state'=>1,
            'category_id'=>2
        ]);

        Subcategory::create([
            'name' => 'camisas',
            'slug' => Str::slug('camisas'),
            'state'=>1,
            'category_id'=>3
        ]);

        Subcategory::create([
            'name' => 'Zapatos',
            'slug' => Str::slug('Zapatos'),
            'state'=>1,
            'category_id'=>3
        ]);

        Subcategory::create([
            'name' => 'Refrigeradoras',
            'slug' => Str::slug('Refrigeradoras'),
            'state'=>0,
            'category_id'=>4
        ]);

        Subcategory::create([
            'name' => 'Cocinas',
            'slug' => Str::slug('Cocinas'),
            'state'=>1,
            'category_id'=>4
        ]);

        Subcategory::create([
            'name' => 'Televisores',
            'slug' => Str::slug('Televisores'),
            'state'=>1,
            'category_id'=>4
        ]);

        Subcategory::create([
            'name' => 'Laptops',
            'slug' => Str::slug('Laptops'),
            'state'=>1,
            'category_id'=>5
        ]);

        Subcategory::create([
            'name' => 'Memorias',
            'slug' => Str::slug('Memorias'),
            'state'=>1,
            'category_id'=>5
        ]);

        Subcategory::create([
            'name' => 'Mouses',
            'slug' => Str::slug('Mouses'),
            'state'=>1,
            'category_id'=>5
        ]);


        Subcategory::create([
            'name' => 'Arros',
            'slug' => Str::slug('Arros'),
            'state'=>1,
            'category_id'=>6
        ]);

        Subcategory::create([
            'name' => 'Frejores',
            'slug' => Str::slug('Frejores'),
            'state'=>1,
            'category_id'=>6
        ]);

        Subcategory::create([
            'name' => 'Lentejas',
            'slug' => Str::slug('Lentejas'),
            'state'=>1,
            'category_id'=>6
        ]);

        Subcategory::create([
            'name' => 'Leche',
            'slug' => Str::slug('Leche'),
            'state'=>1,
            'category_id'=>7
        ]);

        Subcategory::create([
            'name' => 'Yogurt',
            'slug' => Str::slug('Yogurt'),
            'state'=>1,
            'category_id'=>7
        ]);

       /*  Subcategory::create([
            'name' => 'Agua',
            'slug' => Str::slug('Agua'),
            'state'=>1,
            'category_id'=>8
        ]);

        Subcategory::create([
            'name' => 'Gaseosa',
            'slug' => Str::slug('Gaseosa'),
            'state'=>1,
            'category_id'=>8
        ]);

        Subcategory::create([
            'name' => 'Frugos',
            'slug' => Str::slug('Frugos'),
            'state'=>1,
            'category_id'=>9
        ]);

        Subcategory::create([
            'name' => 'Cerveza',
            'slug' => Str::slug('Cerveza'),
            'state'=>1,
            'category_id'=>8
        ]);

        Subcategory::create([
            'name' => 'Vino',
            'slug' => Str::slug('Vino'),
            'state'=>1,
            'category_id'=>9
        ]);

        Subcategory::create([
            'name' => 'Mueble de Sala',
            'slug' => Str::slug('Mueble de Sala'),
            'state'=>1,
            'category_id'=>10
        ]);

        Subcategory::create([
            'name' => 'Mueble de Comedor',
            'slug' => Str::slug('Mueble de Comedor'),
            'state'=>1,
            'category_id'=>10
        ]);

        Subcategory::create([
            'name' => 'Mueble de Dormitorio',
            'slug' => Str::slug('Mueble de Dormitorio'),
            'state'=>1,
            'category_id'=>10
        ]); */

/*         Subcategory::create([
            'name' => 'Sacos Mineros',
            'slug' => Str::slug('Sacos Mineros'),
            'state'=>1,
            'category_id'=>11
        ]);

        Subcategory::create([
            'name' => 'Sacos leno',
            'slug' => Str::slug('Sacos leno'),
            'state'=>1,
            'category_id'=>11
        ]);
 */

    }
}
