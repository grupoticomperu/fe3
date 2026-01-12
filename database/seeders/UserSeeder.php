<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Local;
use App\Models\Company;
use App\Models\Employee;

//importamos para asignar roles y permisos
use App\Models\Position;
use Illuminate\Support\Str;
use App\Models\Tipodecambio;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class UserSeeder extends Seeder
{


    public function run()
    {

        $this->call(BoletadisenosTableSeeder::class);
        $this->call(FacturadisenosTableSeeder::class);
        $this->call(GuiadisenosTableSeeder::class);
        $this->call(NcboletadisenosTableSeeder::class);
        $this->call(NcfacturadisenosTableSeeder::class);

        //creamos la company
        $company = Company::create([
            'ruc' => '',
            'razonsocial' => '',
            'ubigeo' => "",
            'direccion' => '',
            'currency_id' => 1,
            'soluser' => "MODDATOS",
            'solpass' => "MODDATOS",
            'ublversion' => "2.1",
            'detraccion' => 700,
            'ncboletadiseno_id' => 1,
            'ncfacturadiseno_id' => 1,
            'guiadiseno_id' => 1,
            'facturadiseno_id' => 1,
            'boletadiseno_id' => 1,
            'certificate_path' => '',
            //'logo' => 'fe/logos/0jdmPxuXhJXZ4IFjjN11goSZYMg26HkpQ8zg2GOS.png',
            'logo' => '',
            'certificate_path' => "",

        ]);

        //creando empresa de muestra
        /*  $company2 = Company::create([
            'ruc' => '',
            'razonsocial' => '',
            'ubigeo' => "",
            'direccion' => '',
            'currency_id' => 1,
            'soluser' => "MODDATOS",
            'solpass' => "MODDATOS",
            'ublversion' => "2.1",
            'certificate_path' => "",
            'detraccion' => 700,
            
        ]); */




        //$company2 = Company::create(['ruc' => '20447393303', 'razonsocial' => 'BTEC SCRL', 'nombrecomercial' => 'BTEC']);
        //creamos rol para la company creada
        ////$adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador', 'company_id' => $company->id]);
        ////$sellerRole = Role::create(['name' => 'Seller', 'display_name' => 'Vendedor', 'company_id' => $company->id]);
        ////$grocerRole = Role::create(['name' => 'Grocer', 'display_name' => 'Almacenero', 'company_id' => $company2->id]);

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $sellerRole = Role::create(['name' => 'Seller', 'display_name' => 'Vendedor']);
        $grocerRole = Role::create(['name' => 'Grocer', 'display_name' => 'Almacenero']);

        //$adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        //$adminempresaRole = Role::create(['name'=>'Adminempresa','display_name'=>'Administrador de empresa']);
        //$ayudanteRole = Role::create(['name' => 'Ayudante', 'display_name' => 'Ayudante']);
        // $sellerRole = Role::create(['name' => 'Seller', 'display_name' => 'Vendedor']);
        //$grocerRole = Role::create(['name'=>'Grocer','display_name'=>'Alamacenero']);

        //Permission::create(['name' => 'Web View','display_name'=>'Ver Web'])->SyncRoles([$adminRole]);//para que oculte o muestre los campos de web
        //Permission::create(['name' => 'Export Excel', 'display_name' => 'Export Excel'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Export Pdf', 'display_name' => 'Export Pdf'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Import Excel', 'display_name' => 'Import Excel'])->SyncRoles([$adminRole]);
        // Permission::create(['name' => 'Banner Export', 'display_name' => 'Banner Export'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Export Excel', 'display_name' => 'Exportar Excel'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Export Pdf', 'display_name' => 'Exportar Pdf'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Import Excel', 'display_name' => 'Importar Excel'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Banner Export Product', 'display_name' => 'Banner Export'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Sale View', 'display_name' => 'Ver Ventas'])->SyncRoles([$adminRole, $sellerRole]);
        Permission::create(['name' => 'Sale Create', 'display_name' => 'Crear Ventas'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Sale Update', 'display_name' => 'Actualizar Ventas'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Sale Delete', 'display_name' => 'Eliminar Ventas'])->SyncRoles([$adminRole]);

        /*         Permission::create(['name' => 'Shopping View', 'display_name' => 'Ver Compras'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Shopping Create', 'display_name' => 'Crear Compras'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Shopping Update', 'display_name' => 'Actualizar Compras'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Shopping Delete', 'display_name' => 'Eliminar Compras'])->SyncRoles([$adminRole]); */

        /*         Permission::create(['name' => 'Inventory View', 'display_name' => 'Ver Inventario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Inventory Create', 'display_name' => 'Crear Inventario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Inventory Update', 'display_name' => 'Actualizar Inventario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Inventory Delete', 'display_name' => 'Eliminar Inventario'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Initialinventory View', 'display_name' => 'Ver Inventario Inicial'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Initialinventory Create', 'display_name' => 'Crear Inventario Inicial'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Initialinventory Update', 'display_name' => 'Actualizar Inventario Inicial'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Initialinventory Delete', 'display_name' => 'Eliminar Inventario Inicial'])->SyncRoles([$adminRole]); */

        Permission::create(['name' => 'Product View', 'display_name' => 'Ver Productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Product Create', 'display_name' => 'Crear Productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Product Update', 'display_name' => 'Actualizar Productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Product Delete', 'display_name' => 'Eliminar Productos'])->SyncRoles([$adminRole]);

        //desde aqui

        Permission::create(['name' => 'Configuration View', 'display_name' => 'Ver Configuración'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Configuration Create', 'display_name' => 'Crear Configuración'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Configuration Update', 'display_name' => 'Actualizar Configuración'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Configuration Delete', 'display_name' => 'Eliminar Configuración'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Modelo View', 'display_name' => 'Ver Modelo de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Modelo Create', 'display_name' => 'Crear Modelo de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Modelo Update', 'display_name' => 'Actualizar Modelo de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Modelo Delete', 'display_name' => 'Eliminar Modelo de productos'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Category View', 'display_name' => 'Ver Categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Create', 'display_name' => 'Crear Categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Update', 'display_name' => 'Actualizar Categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Delete', 'display_name' => 'Eliminar Categoria de productos'])->SyncRoles([$adminRole]);

        /*  Permission::create(['name' => 'Subcategory View', 'display_name' => 'Ver Sub categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Subcategory Create', 'display_name' => 'Crear Sub categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Subcategory Update', 'display_name' => 'Actualizar Sub categoria de productos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Subcategory Delete', 'display_name' => 'Eliminar Sub categoria de productos'])->SyncRoles([$adminRole]); */

        Permission::create(['name' => 'Brand View', 'display_name' => 'Ver Marca'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Create', 'display_name' => 'Crear Marca'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Update', 'display_name' => 'Actualizar Marca'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Delete', 'display_name' => 'Eliminar Marca'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Show', 'display_name' => 'Mostrar Marca'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'User View', 'display_name' => 'Ver Usuario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Create', 'display_name' => 'Crear Usuario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Update', 'display_name' => 'Actualizar Usuario'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Delete', 'display_name' => 'Eliminar Usuario'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Role View', 'display_name' => 'Ver Roles'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Create', 'display_name' => 'Crear Roles'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Update', 'display_name' => 'Actualizar Roles'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Delete', 'display_name' => 'Eliminar Roles'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Permission View', 'display_name' => 'Ver Permisos'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Permission Update', 'display_name' => 'Actualizar Permisos'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Local View', 'display_name' => 'Ver Local'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Local Create', 'display_name' => 'Crear Local'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Local Update', 'display_name' => 'Actualizar Local'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Local Delete', 'display_name' => 'Eliminar Local'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Customer View', 'display_name' => 'Ver Cliente'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Customer Create', 'display_name' => 'Crear Cliente'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Customer Update', 'display_name' => 'Actualizar Cliente'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Customer Delete', 'display_name' => 'Eliminar Cliente'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Transportista View', 'display_name' => 'Ver Transportista'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Transportista Create', 'display_name' => 'Crear Transportista'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Transportista Update', 'display_name' => 'Actualizar Transportista'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Transportista Delete', 'display_name' => 'Eliminar Transportista'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Puntodepartida View', 'display_name' => 'Ver Puntodepartida'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Puntodepartida Create', 'display_name' => 'Crear Puntodepartida'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Puntodepartida Update', 'display_name' => 'Actualizar Puntodepartida'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Puntodepartida Delete', 'display_name' => 'Eliminar Puntodepartida'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Conductor View', 'display_name' => 'Ver Conductor'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Conductor Create', 'display_name' => 'Crear Conductor'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Conductor Update', 'display_name' => 'Actualizar Conductor'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Conductor Delete', 'display_name' => 'Eliminar Conductor'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Vehiculo View', 'display_name' => 'Ver Vehiculo'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Vehiculo Create', 'display_name' => 'Crear Vehiculo'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Vehiculo Update', 'display_name' => 'Actualizar Vehiculo'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Vehiculo Delete', 'display_name' => 'Eliminar Vehiculo'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Guia View', 'display_name' => 'Ver Guia'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guia Create', 'display_name' => 'Crear Guia'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guia Update', 'display_name' => 'Actualizar Guia'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guia Delete', 'display_name' => 'Eliminar Guia'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Boletadiseno View', 'display_name' => 'Ver Boletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Boletadiseno Create', 'display_name' => 'Crear Boletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Boletadiseno Update', 'display_name' => 'Actualizar Boletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Boletadiseno Delete', 'display_name' => 'Eliminar Boletadiseno'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Facturadiseno View', 'display_name' => 'Ver Facturadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Facturadiseno Create', 'display_name' => 'Crear Facturadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Facturadiseno Update', 'display_name' => 'Actualizar Facturadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Facturadiseno Delete', 'display_name' => 'Eliminar Facturadiseno'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Guiadiseno View', 'display_name' => 'Ver Guiadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guiadiseno Create', 'display_name' => 'Crear Guiadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guiadiseno Update', 'display_name' => 'Actualizar Guiadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Guiadiseno Delete', 'display_name' => 'Eliminar Guiadiseno'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Ncboletadiseno View', 'display_name' => 'Ver Ncboletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Ncboletadiseno Create', 'display_name' => 'Crear Ncboletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Ncboletadiseno Update', 'display_name' => 'Actualizar Ncboletadiseno'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Ncboletadiseno Delete', 'display_name' => 'Eliminar Ncboletadiseno'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Comprobante View', 'display_name' => 'Ver Comprobante'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Comprobante Create', 'display_name' => 'Crear Comprobante'])->SyncRoles([$adminRole]);

        //creando empresa de muestra


        //creando empresa de muestra
        $tc = Tipodecambio::create([
            'valorventa' => 3.7,
            'valorcompra' => 3.6,
            //'fecha' => Carbon::now(),
            'fecha' => Carbon::now()->format('Y-m-d H:i:s'),
            'currency_id' => 1,
            'company_id' => 1,

        ]);


        //creando local principal de company
        $local = Local::create([
            'name' => 'local principal',
            'company_id' => $company->id,
        ]);

        //creando posicion o profesion o cargo
        $position = Position::create([
            'name' => 'Administrador',
            'company_id' => $company->id,
        ]);
        /*         $positionseller = Position::create([
            'name' => 'Vendedor',
            'company_id' => $company->id,
        ]); */


        //creando usuario admin
        $admin = User::create([
            'name' => 'Michael',
            'email' => 'michael@ticomperu.com',
            'email_verified_at' => now(),
            'company_id' => $company->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole($adminRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av Jose galvez 1731',
            'movil' => '996929478',
            'dni' => '10133423',
            'gender' => 1,
            'user_id' => $admin->id,
            'local_id' => $local->id,
            'position_id' => $position->id,
            'company_id' => $company->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);



        $admin2 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'company_id' => $company->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin2->assignRole($adminRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av Jose galvez 1731',
            'movil' => '996929478',
            'dni' => '10133425',
            'gender' => 1,
            'user_id' => $admin2->id,
            'local_id' => $local->id,
            'position_id' => $position->id,
            'company_id' => $company->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);



        //creando usuario vendor
        /* $seller = User::create([
            'name' => 'joffre',
            'email' => 'joffre@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $seller->assignRole($sellerRole); */


        //creando empleado vendedor seller
        /* Employee::create([
            'address' => 'Av lopez cadiz 1791',
            'movil' => '996559478',
            'dni' => '14533423',
            'gender' => 1,
            'user_id' => $seller->id,
            'local_id' => 1,
            'position_id' => $positionseller->id,

        ]); */


        /* $admin = User::create([
            'name' => 'luis',
            'email' => 'luis@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]); */

        //creando empleado vendedor seller
        /* Employee::create([
            'address' => 'Av lopez cadiz 1791',
            'movil' => '996559478',
            'dni' => '14533423',
            'gender' => 1,
            'user_id' => $admin->id,
            'local_id' => 2,
            'position_id' => $positionseller->id,

        ]); */






        /*         $admin = User::create([
            'name' => 'leydy',
            'email' => 'leydy@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]); */

        //creando empleado vendedor seller
        /*         Employee::create([
            'address' => 'Av lopez cadiz 1791',
            'movil' => '996559478',
            'dni' => '14533423',
            'gender' => 1,
            'user_id' => $admin->id,
            'local_id' => 2,
            'position_id' => $positionseller->id,

        ]); */





        /*         $admin = User::create([
            'name' => 'flor',
            'email' => 'flor@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]); */

        //creando empleado vendedor seller
        /* Employee::create([
            'address' => 'Av lopez cadiz 1791',
            'movil' => '996559478',
            'dni' => '14533423',
            'gender' => 1,
            'user_id' => $admin->id,
            'local_id' => 3,
            'position_id' => $positionseller->id,

        ]); */




        //creando usuarioa sin employee, da error al mostrar datos por eso lo comente
        /*         User::create([
            'name' => 'pepe',
            'email' => 'pepe@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'deyna',
            'email' => 'deyna@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]); */







        //creando empresa de muestra
        /* $tc = Tipodecambio::create([
            'valorventa' => 3.7,
            'valorcompra' => 3.6,
            'fecha' => Carbon::now()->format('Y-m-d H:i:s'),
            'currency_id' => 1,
            'company_id' => 2,

        ]); */


        //creando local principal de company
        /* $localx = Local::create([
            'name' => 'local secundario',
            'company_id' => $company2->id,
        ]);
 */
        //creando posicion o profesion o cargo
        /* $positionx = Position::create([
            'name' => 'Administrador',
            'company_id' => $company2->id,
        ]); */
        /*         $positionseller = Position::create([
    'name' => 'Vendedor',
    'company_id' => $company->id,
]); */


        //creando usuario admin


        //creando empleado admin
        /* Employee::create([
            'address' => 'Av mariategui 1731',
            'movil' => '996929470',
            'dni' => '11133423',
            'gender' => 1,
            'user_id' => $adminx->id,
            'local_id' => $localx->id,
            'position_id' => $positionx->id,
            'company_id' => $company2->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]); */
    }
}
