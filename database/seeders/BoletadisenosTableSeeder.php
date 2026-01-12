<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoletadisenosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('boletadisenos')->delete();
        
        \DB::table('boletadisenos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'boleta ticket con nombre sin logo',
                'nameblade' => 'admin.comprobante.boletadiseno1',
                'image1' => 'fe/ticom_srl/disenos/OoUHdNYTcxxxR3CQjtbsx7CPfBeflvLmgnoasXZP.jpg',
                'image2' => 'fe/ticom/disenos/my3CXq1jdXFGDRzuQ9MVs5GaqIQLaV7hFiIRw7TE.jpg',
                'state' => 1,
                'order' => 1,
                'description' => 'ticket',
                'created_at' => NULL,
                'updated_at' => '2025-12-26 04:40:33',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'boleta ticket con logo',
                'nameblade' => 'admin.comprobante.boletadiseno2',
                'image1' => 'fe/ticom_srl/disenos/rx8D4JLbvvBd87LcCAJOuLzccovY46FpVaNwWva0.jpg',
                'image2' => '0',
                'state' => 1,
                'order' => 1,
                'description' => 'ticket',
                'created_at' => '2025-12-20 05:20:31',
                'updated_at' => '2025-12-26 05:03:27',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'boleta ticket sin borde y sin logo',
                'nameblade' => 'admin.comprobante.boletadiseno3',
                'image1' => 'fe/ticom_srl/disenos/gjZIxVfWRtGRpMm24W2tcQZMHJ8C0evzP1RPw5NB.jpg',
                'image2' => 'fe/default/products/productdefault.jpg',
                'state' => 1,
                'order' => 3,
                'description' => 'ticket',
                'created_at' => '2025-12-26 01:24:48',
                'updated_at' => '2025-12-26 04:53:15',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'boleta ticket sin borde con logo',
                'nameblade' => 'admin.comprobante.boletadiseno4',
                'image1' => 'fe/ticom_srl/disenos/pP1ovKzYBRe6Sio5ykFEQRBKMvXZyYq12gxBE4EX.jpg',
                'image2' => 'fe/default/products/productdefault.jpg',
                'state' => 1,
                'order' => 5,
                'description' => 'ticket',
                'created_at' => '2025-12-26 01:29:16',
                'updated_at' => '2025-12-26 04:59:17',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'boleta diseno a4',
                'nameblade' => 'admin.comprobante.boleta1disenoa4',
                'image1' => 'fe/TICOM SRL/disenos/EnTMFcATlvRN69Q1termos5L4EBYU9ZkiZWoQXL9.jpg',
                'image2' => 'fe/default/products/productdefault.jpg',
                'state' => 1,
                'order' => 6,
                'description' => 'a4',
                'created_at' => '2025-12-26 05:35:57',
                'updated_at' => '2025-12-26 05:39:13',
            ),
        ));
        
        
    }
}