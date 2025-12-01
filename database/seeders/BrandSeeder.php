<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'adidas',
            'slug'=>'adidas',
            'state' => 1,
            'image' => 'fe/default/brands/branddefault.jpg',
            'company_id' => 1,
        ]);

        Brand::create([
            'name' => 'nike',
            'slug'=>'nike',
            'state' => 1,
            'image' => 'fe/default/brands/branddefault.jpg',
            'company_id' => 1,
        ]);

        Brand::create([
            'name' => 'bonaroti',
            'slug'=>'bonaroti',
            'state' => 1,
            'image' => 'fe/default/brands/branddefault.jpg',
            'company_id' => 1,
        ]);


        Brand::create([
            'name' => 'ohchica',
            'slug'=>'ohchica',
            'state' => 1,
            'image' => 'fe/default/brands/branddefault.jpg',
            'company_id' => 1,
        ]);

        Brand::create([
            'name' => 'manfin',
            'slug'=>'manfin',
            'state' => 1,
            'image' => 'fe/default/brands/branddefault.jpg',
            'company_id' => 1,
        ]);
    }
}
