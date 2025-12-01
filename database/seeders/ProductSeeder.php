<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    public function run()
    {

        Product::create([
            'codigo' => '1',
            'codigobarras' => '1b',
            'name' => 'camisa',
            'description' => 'descripcion de camisa',
            'purchaseprice' => 98,
            'saleprice' => 118,
            'mtovalorunitario' => 100, //precio sin igv
            'salepricemin' => 100,
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '2',
            'codigobarras' => '2b',
            'name' => 'polo',
            'description' => 'descripcion de polo',
            'purchaseprice' => 50,
            'saleprice' => 59,
            'mtovalorunitario' => 50, //precio sin igv
            'salepricemin' => 60,
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '3',
            'codigobarras' => '3ax',
            'name' => 'pantalon',
            'description' => 'descripcion de pantalon',
            'purchaseprice' => 8,
            'saleprice' => 11.8,
            'salepricemin' => 10,
            'mtovalorunitario' => 10, //precio sin igv
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '4',
            'codigobarras' => '4ax',
            'name' => 'casaca',
            'description' => 'descripcion de casaca',
            'purchaseprice' => 36,
            'saleprice' => 47.20,
            'mtovalorunitario' => 40, //precio sin igv
            'salepricemin' => 45,
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);


        Product::create([
            'codigo' => '5',
            'codigobarras' => '5mn',
            'name' => 'buzo',
            'description' => 'descripcion de buzo',
            'purchaseprice' => 83,
            'saleprice' => 141.60,
            'mtovalorunitario' => 120, //precio sin igv
            'salepricemin' => 93,
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);




        Product::create([
            'codigo' => '11',
            'codigobarras' => '1bb',
            'name' => 'camisa',
            'description' => 'descripcion de camisa',
            'purchaseprice' => 900,
            'saleprice' => 1180,
            'mtovalorunitario' => 1000, //precio sin igv
            'salepricemin' => 1080,
            'company_id'=> 2,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '12',
            'codigobarras' => '2bb',
            'name' => 'polo',
            'description' => 'descripcion de polo',
            'purchaseprice' => 120,
            'saleprice' => 177,
            'mtovalorunitario' => 150, //precio sin igv
            'salepricemin' => 170,
            'company_id'=> 2,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '13',
            'codigobarras' => '3axx',
            'name' => 'pantalon',
            'description' => 'descripcion de pantalon',
            'purchaseprice' => 153,
            'saleprice' => 354,
            'mtovalorunitario' => 300, //precio sin igv
            'salepricemin' => 320,
            'company_id'=> 2,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '14',
            'codigobarras' => '4axx',
            'name' => 'casaca',
            'description' => 'descripcion de casaca',
            'purchaseprice' => 30,
            'saleprice' => 35.4,
            'mtovalorunitario' => 30, //precio sin igv
            'salepricemin' => 33,
            'company_id'=> 2,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);


        Product::create([
            'codigo' => '15',
            'codigobarras' => '5mnn',
            'name' => 'buzo',
            'description' => 'descripcion de buzo',
            'purchaseprice' => 13,
            'saleprice' => 23.60,
            'mtovalorunitario' => 20, //precio sin igv
            'salepricemin' => 23,
            'company_id'=> 2,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'esbolsa' => 0,
            'state' => 1,
        ]);

        Product::create([
            'codigo' => '16',
            'codigobarras' => '1bo',
            'name' => 'bolsa',
            'description' => 'descripcion de labolsa',
            'purchaseprice' => 0.01,
            'saleprice' => 0.059,
            'mtovalorunitario' => 0.05, //precio sin igv
            'salepricemin' => 0.05,
            'company_id'=> 1,
            'currency_id'=> 1,
            'um_id'=> 1,
            'modelo_id'=> 1,
            'category_id'=> 1,
            'tipoafectacion_id'=> 1,
            'brand_id'=> 1,
            'state' => 1,
            'esbolsa' => 1,
        ]);


    }
}
