<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipodocumento_id' => 2,
                'numdoc' => '10133928',
                'nomrazonsocial' => 'ticom perux',
                'nombrecomercial' => NULL,
                'address' => 'av petit thouars 1255',
                'department_id' => NULL,
                'province_id' => NULL,
                'district_id' => NULL,
                'company_id' => NULL,
                'phone' => '266250',
                'movil' => '996929478',
                'email' => 'mcaal@hotmail.com',
                'contact' => 'mike',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'tipodocumento_id' => 2,
                'numdoc' => '19133420',
                'nomrazonsocial' => 'btecperu',
                'nombrecomercial' => NULL,
                'address' => 'av raranibar 122',
                'department_id' => NULL,
                'province_id' => NULL,
                'district_id' => NULL,
                'company_id' => NULL,
                'phone' => '2662540',
                'movil' => '996929478',
                'email' => 'mmm@mmm.com',
                'contact' => 'james',
                'state' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'tipodocumento_id' => 4,
                'numdoc' => '20447393302',
                'nomrazonsocial' => 'TICOM SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA',
                'nombrecomercial' => 'TICOM SCRL',
                'address' => 'AV. DU PETIT THOUARS NRO. 1251 DPTO. 302 URB. SANTA BEATRIZ',
                'department_id' => '15',
                'province_id' => '1501',
                'district_id' => '150101',
                'company_id' => 1,
                'phone' => NULL,
                'movil' => NULL,
                'email' => NULL,
                'contact' => NULL,
                'state' => 1,
                'created_at' => '2024-03-22 23:38:12',
                'updated_at' => '2024-03-22 23:38:12',
            ),
            3 => 
            array (
                'id' => 4,
                'tipodocumento_id' => 4,
                'numdoc' => '20543886671',
                'nomrazonsocial' => 'IMPORTACIONES IMPACTO S.A.C.',
                'nombrecomercial' => 'IMPORTACIONES IMPACTO',
            'address' => 'AV. BOLIVIA NRO. 148 INT. 553 CERCADO DE LIMA (FRONTIS DE LA ONP - CENTRO CIVICO)',
                'department_id' => '15',
                'province_id' => '1501',
                'district_id' => '150101',
                'company_id' => 1,
                'phone' => NULL,
                'movil' => NULL,
                'email' => NULL,
                'contact' => NULL,
                'state' => 1,
                'created_at' => '2024-03-22 23:39:26',
                'updated_at' => '2024-03-22 23:39:26',
            ),
        ));
        
        
    }
}