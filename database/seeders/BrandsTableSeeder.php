<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'adidas',
                'slug' => 'adidas',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => NULL,
                'company_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'keywords' => NULL,
                'created_at' => '2024-04-27 22:18:21',
                'updated_at' => '2024-04-27 22:18:21',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'nike',
                'slug' => 'nike',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => NULL,
                'company_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'keywords' => NULL,
                'created_at' => '2024-04-27 22:18:21',
                'updated_at' => '2024-04-27 22:18:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'bonaroti',
                'slug' => 'bonaroti',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => NULL,
                'company_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'keywords' => NULL,
                'created_at' => '2024-04-27 22:18:21',
                'updated_at' => '2024-04-27 22:18:21',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ohchica',
                'slug' => 'ohchica',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => NULL,
                'company_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'keywords' => NULL,
                'created_at' => '2024-04-27 22:18:21',
                'updated_at' => '2024-04-27 22:18:21',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'manfin',
                'slug' => 'manfin',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => NULL,
                'company_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'keywords' => NULL,
                'created_at' => '2024-04-27 22:18:21',
                'updated_at' => '2024-04-27 22:18:21',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'PIEL',
                'slug' => 'piel',
                'state' => 1,
                'image' => 'fe/default/brands/branddefault.jpg',
                'order' => 7,
                'company_id' => 1,
                'title' => 'piel',
                'description' => 'piel',
                'keywords' => 'piel',
                'created_at' => '2024-04-28 03:15:41',
                'updated_at' => '2024-04-28 03:15:41',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'HP',
                'slug' => 'hp',
                'state' => 1,
                'image' => 'fe/1/brands/B4mh68vSAq1GwwZ5wLdkvZceP2u1QQaVTGGCEO8I.jpg',
                'order' => 3,
                'company_id' => 1,
                'title' => 'hp',
                'description' => 'hp',
                'keywords' => 'hp',
                'created_at' => '2024-04-28 03:34:58',
                'updated_at' => '2024-04-28 16:41:46',
            ),
        ));
        
        
    }
}