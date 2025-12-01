<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tenants')->delete();
        
        \DB::table('tenants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'abcfe3',
                'domain' => 'abc.fe3.test',
                'database' => 'abcfe3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'fe3',
                'domain' => 'fe3.test',
                'database' => 'fe3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'xyzfe3',
                'domain' => 'xyz.fe3.test',
                'database' => 'xyzfe3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}