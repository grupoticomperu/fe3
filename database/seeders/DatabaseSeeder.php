<?php

namespace Database\Seeders;

use App\Models\Initialinventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //$this->call(CategorySeeder::class);

        //$this->call(SubcategorySeeder::class);
        Storage::deleteDirectory('public/categories');
        Storage::makeDirectory('public/categories');

        Storage::deleteDirectory('public/brands');
        Storage::makeDirectory('public/brands');

        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/products');

        // \App\Models\User::factory(10)->create();

        //\App\Models\Category::factory(20)->create();

        //\App\Models\Brand::factory(5)->create();
        //\App\Models\Modelo::factory(5)->create();
        $this->call(CurrencySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(ConfigurationSeeder::class);

        $this->call(UmSeeder::class);
        $this->call(ModeloSeeder::class);
        $this->call(CategorySeeder::class);

        //$this->call(CtacteSeeder::class);

        $this->call(TaxSeeder::class);


        //\App\Models\Product::factory(10)->create();
        //$this->call(LocalSeeder::class);

        //$this->call(UserSeeder::class);
        //$this->call(InitialinventorySeeder::class);
        $this->call(TipoafectacionsTableSeeder::class);
        $this->call(TipocomprobanteSeeder::class);
        $this->call(TipodocumentoSeeder::class);
        $this->call(ProductSeeder::class);


       // \App\Models\Customer::factory(50)->create();

        //$this->call(LocalTipocomprobanteSeeder::class);

       // $this->call(GroupatributeSeeder::class);
        //$this->call(AtributeSeeder::class);


       // $this->call(ProductfamiliesTableSeeder::class);
       // $this->call(ProductatributesTableSeeder::class);
       // $this->call(AtributeProductatributeTableSeeder::class);
       // $this->call(LocalProductatributeTableSeeder::class);

        //\App\Models\Supplier::factory(50)->create();
        $this->call(LocalTipocomprobantesTableSeeder::class);
        $this->call(PaymenttypesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(TipodeoperacionsTableSeeder::class);
        $this->call(ImpuestosTableSeeder::class);

        $this->call(TipodenotadecreditosTableSeeder::class);
       // $this->call(ComprobantesTableSeeder::class);
       // $this->call(FacturasTableSeeder::class);
       // $this->call(BoletasTableSeeder::class);
       // $this->call(ComprobanteProductoTableSeeder::class);
        $this->call(TransportistasTableSeeder::class);
        $this->call(MotivotrasladosTableSeeder::class);
        $this->call(VehiculosTableSeeder::class);
        $this->call(ConductorsTableSeeder::class);
        $this->call(PuntodepartidasTableSeeder::class);

        $this->call(BrandsTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
        //$this->call(TenantsTableSeeder::class);
                    
    }
}
