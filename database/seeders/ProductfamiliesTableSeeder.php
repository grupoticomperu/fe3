<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductfamiliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('productfamilies')->delete();
        
        \DB::table('productfamilies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'snikers Leone Shields nike',
                'slug' => 'snikers-leone-shields-nike',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 4,
                'modelo_id' => 3,
                'brand_id' => 2,
                'created_at' => '2023-06-07 01:00:01',
                'updated_at' => '2023-06-07 01:00:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'faldas Modelo Venecia manfin',
                'slug' => 'faldas-modelo-venecia-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 7,
                'modelo_id' => 6,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:15:19',
                'updated_at' => '2023-06-08 00:15:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'camisas Modelo Django manfin',
                'slug' => 'camisas-modelo-django-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 1,
                'gender' => '1',
                'flag' => 0,
                'subcategory_id' => 10,
                'modelo_id' => 10,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:19:37',
                'updated_at' => '2023-06-08 00:19:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'camisas Modelo Estrella manfin',
                'slug' => 'camisas-modelo-estrella-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '1',
                'flag' => 0,
                'subcategory_id' => 10,
                'modelo_id' => 9,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:34:10',
                'updated_at' => '2023-06-08 00:34:10',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'polos Modelo Flor ohchica',
                'slug' => 'polos-modelo-flor-ohchica',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 6,
                'modelo_id' => 7,
                'brand_id' => 4,
                'created_at' => '2023-06-08 00:36:02',
                'updated_at' => '2023-06-08 00:36:02',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'camisas Ms. Josianne Corwin DDS manfin',
                'slug' => 'camisas-ms-josianne-corwin-dds-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '1',
                'flag' => 0,
                'subcategory_id' => 10,
                'modelo_id' => 2,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:38:24',
                'updated_at' => '2023-06-08 00:38:24',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'camisas Troy Homenick II bonaroti',
                'slug' => 'camisas-troy-homenick-ii-bonaroti',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '1',
                'flag' => 0,
                'subcategory_id' => 10,
                'modelo_id' => 5,
                'brand_id' => 3,
                'created_at' => '2023-06-08 00:40:04',
                'updated_at' => '2023-06-08 00:40:04',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'brazieres Modelo Laydy adidas',
                'slug' => 'brazieres-modelo-laydy-adidas',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 9,
                'modelo_id' => 8,
                'brand_id' => 1,
                'created_at' => '2023-06-08 00:41:19',
                'updated_at' => '2023-06-08 00:41:19',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'faldas Modelo Venecia bonaroti',
                'slug' => 'faldas-modelo-venecia-bonaroti',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 7,
                'modelo_id' => 6,
                'brand_id' => 3,
                'created_at' => '2023-06-08 00:43:31',
                'updated_at' => '2023-06-08 00:43:31',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'pantalon pitillo Prof. Paul Gibson manfin',
                'slug' => 'pantalon-pitillo-prof-paul-gibson-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 8,
                'modelo_id' => 1,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:44:28',
                'updated_at' => '2023-06-08 00:44:28',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'bluzas floriadas Leone Shields ohchica',
                'slug' => 'bluzas-floriadas-leone-shields-ohchica',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 2,
                'modelo_id' => 3,
                'brand_id' => 4,
                'created_at' => '2023-06-08 00:45:16',
                'updated_at' => '2023-06-08 00:45:16',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'brazieres Modelo Polar nike',
                'slug' => 'brazieres-modelo-polar-nike',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 9,
                'modelo_id' => 11,
                'brand_id' => 2,
                'created_at' => '2023-06-08 00:46:11',
                'updated_at' => '2023-06-08 00:46:11',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'snikers Daphnee Carter IV nike',
                'slug' => 'snikers-daphnee-carter-iv-nike',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 4,
                'modelo_id' => 4,
                'brand_id' => 2,
                'created_at' => '2023-06-08 00:47:19',
                'updated_at' => '2023-06-08 00:47:19',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'bluzas floriadas Modelo Estrella adidas',
                'slug' => 'bluzas-floriadas-modelo-estrella-adidas',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 2,
                'modelo_id' => 9,
                'brand_id' => 1,
                'created_at' => '2023-06-08 00:48:02',
                'updated_at' => '2023-06-08 00:48:02',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'faldas Modelo Django manfin',
                'slug' => 'faldas-modelo-django-manfin',
                'description' => NULL,
                'state' => 1,
                'tipo' => '2',
                'haveserialnumber' => 0,
                'gender' => '2',
                'flag' => 0,
                'subcategory_id' => 7,
                'modelo_id' => 10,
                'brand_id' => 5,
                'created_at' => '2023-06-08 00:48:50',
                'updated_at' => '2023-06-08 00:48:50',
            ),
        ));
        
        
    }
}