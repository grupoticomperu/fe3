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

        //creamos la company
        $company = Company::create([
            'ruc' => '20447393302',
            'razonsocial' => 'TICOM',
            'ubigeo' => "150101",
            'direccion' => 'Av. Peru 1255',
            'currency_id' => 1,
            'soluser' => "MODDATOS",
            'solpass' => "MODDATOS",
            'ublversion' => "2.1",
            'detraccion' => 700,
            'certificate_path' => 'fe/certificados/dy2eLjhjZJvYb9P2XOM86KTqC8sfpoQIE9vmw4zb.txt',
            //'logo' => 'fe/logos/0jdmPxuXhJXZ4IFjjN11goSZYMg26HkpQ8zg2GOS.png',
            'logo' => '',
            'certificate_path' => "certificates/certificate_1.pem",
            'certificado' => "-----BEGIN PRIVATE KEY-----
            MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDUHbPExymJyOWE
            bxY4TlCufbh54zUAonBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8
            qwyRaNiIGTsqrSSshMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6
            wQ+paBhobLFFgkul4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnlt
            bTytNN5j7HBq0sWNvduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzB
            Erhme9d6DM7SXY44GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I
            18yGrcfRAgMBAAECggEADoQd2lia4iAKfP6xMZdCdD6MUmMXLHzxXIlXifDpb5aS
            sokmv7M57tzrobEMMQZ91LO3KqUq03SE1oQKLyVStDWt0+TXfqrz5eK8jbAuy0FG
            7Hjy3qmpIk349rcHxrd5pfXXPDOEDUA/m7v8m2ZRTUwq8YvSK37l72in4j7HqeJR
            HvFbf/G1GqRpyKQO8aRenPmtE4gD9JVIRFIj6tNaSvBzRpnDTGDpYUriOISic3WJ
            YMHr2ANM2hKTz2YQG7JmRvwGR1zULTLNyoThLFtP6MTOgq04zfWB55ZLveO8JCww
            HxuK85+k5MQ4GSu1nUe+HLxS7uZ5625w7ZB+t42iAQKBgQD69+DV3xL1R7XYckQ6
            TZ6MG8aZYOPqIMEvLyThUGvc6afz3aPhn7494I+jmBqK9P3juVG0RG1MS84mwpG2
            mg9qwzY213OQvasdbi/KFN8kMdt7AYu5IJ0ISHCGv3fMXi3+mOD6MlG3BMsngNow
            6uml2H0z8Pv1FVqooygP0uNycQKBgQDYXmkcqWnCtnzwh1fCKTII0GkWCE8RJNXv
            6N52Im9T4hvys9LT00YCJ6ma2EWpSflpLkreDj71BVPVTh5TFUTk9M4xvjLDdcLQ
            E27oFWxIMmeX/2lZnoS6/d2tm++Zwi3rXA6N0zVENzFfruPVBeOAaFfP5L1KtKRj
            4uE1bAWbYQKBgQCHMZDEpW6pAwBKoQNwBPAruaq6ZR9huFNY/6R2W8Q/NP9stzDZ
            EhyBaL73+bASuvcp/WKuIU5fk1ZyOs4T99nmQVKrKFTw27uaFwlXavbpoJIDKUoD
            aDYviBZWAD6gsPtF80T+gqzSUpq9pQPk5icHWB/aIy8XT3GO9pVWMNylgQKBgCCi
            lN4i23XoCo5JC76YchiMPt144VwnnzExgaR16y7O0wJXhzw2CMA4dUeKyW8QXlM0
            DUzS/0H7zLpGryI++gZCunscQhHjSEAUPk05NfzpxWBSwPQoicKemfoepBQgCscO
            Oo+/xLAGVyckfO7blYX/twb/bGHBP25lgSyKn4nhAoGACvOKOL9vyziaLeISY85f
            jG1TfeCKG7zsbw95Oy4qfccpSUUgLFuR35A56G0OAc7GNXqrTZ6UjrAJltT5bG+J
            u5grbeJ4i1pF/6xoh/pjtfWLUUbsghgRqCqv0z5YemopXTEpVE/vPPC2JhZHfTVO
            nnk/MZT7Cwl87tYexykKDbc=
            -----END PRIVATE KEY-----
            -----BEGIN CERTIFICATE-----
            MIIFCDCCA/CgAwIBAgIJAMwye7towTY2MA0GCSqGSIb3DQEBCwUAMIIBDTEbMBkG
            CgmSJomT8ixkARkWC0xMQU1BLlBFIFNBMQswCQYDVQQGEwJQRTENMAsGA1UECAwE
            TElNQTENMAsGA1UEBwwETElNQTEYMBYGA1UECgwPVFUgRU1QUkVTQSBTLkEuMUUw
            QwYDVQQLDDxETkkgOTk5OTk5OSBSVUMgMjA2MDkyNzgyMzUgLSBDRVJUSUZJQ0FE
            TyBQQVJBIERFTU9TVFJBQ0nDk04xRDBCBgNVBAMMO05PTUJSRSBSRVBSRVNFTlRB
            TlRFIExFR0FMIC0gQ0VSVElGSUNBRE8gUEFSQSBERU1PU1RSQUNJw5NOMRwwGgYJ
            KoZIhvcNAQkBFg1kZW1vQGxsYW1hLnBlMB4XDTIzMDUyNTE0NDIyMVoXDTI1MDUy
            NDE0NDIyMVowggENMRswGQYKCZImiZPyLGQBGRYLTExBTUEuUEUgU0ExCzAJBgNV
            BAYTAlBFMQ0wCwYDVQQIDARMSU1BMQ0wCwYDVQQHDARMSU1BMRgwFgYDVQQKDA9U
            VSBFTVBSRVNBIFMuQS4xRTBDBgNVBAsMPEROSSA5OTk5OTk5IFJVQyAyMDYwOTI3
            ODIzNSAtIENFUlRJRklDQURPIFBBUkEgREVNT1NUUkFDScOTTjFEMEIGA1UEAww7
            Tk9NQlJFIFJFUFJFU0VOVEFOVEUgTEVHQUwgLSBDRVJUSUZJQ0FETyBQQVJBIERF
            TU9TVFJBQ0nDk04xHDAaBgkqhkiG9w0BCQEWDWRlbW9AbGxhbWEucGUwggEiMA0G
            CSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDUHbPExymJyOWEbxY4TlCufbh54zUA
            onBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8qwyRaNiIGTsqrSSs
            hMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6wQ+paBhobLFFgkul
            4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnltbTytNN5j7HBq0sWN
            vduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzBErhme9d6DM7SXY44
            GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I18yGrcfRAgMBAAGj
            ZzBlMB0GA1UdDgQWBBShW9h2j1hnFWmHL+95E8qbgMHlwDAfBgNVHSMEGDAWgBSh
            W9h2j1hnFWmHL+95E8qbgMHlwDATBgNVHSUEDDAKBggrBgEFBQcDATAOBgNVHQ8B
            Af8EBAMCB4AwDQYJKoZIhvcNAQELBQADggEBABWmSUiUwKCR+E//0BBCngo3vT3b
            J13diCsoPOIcWzRQqE+qQ+pbBwXISke5w0gv6+gV/E/r8yiNqwuJnoM1/5jyFe4j
            mF2gIgL0kpiWtnkrT4qn24Y5t/FuQKJtbZx4ec0Uh6n7NzmUoTjm2tP42IqhLQSn
            GhWXXnXxh9XGjeVc7SdCIsyvAQ+CbTXJPvIfwTpTtg500NOQaGEIP3lBd5dNLcEp
            sErwCa4Ln2Hob2wSXeA3FX8qutkHhiVyGAxaLsy2aW5xVBeR4G24WAYtnjiARYTm
            Q03NoAh6oA46zA1LzaF+lpcIPbqNAdb4B4gJ0os+mCgwXx8DkEMSSZvWUMI=
            -----END CERTIFICATE-----
            ",
        ]);

        //creando empresa de muestra
        $company2 = Company::create([
            'ruc' => '20447393360',
            'razonsocial' => 'MXN',
            'ubigeo' => "10012",
            'direccion' => 'Av. Lima 1255',
            'currency_id' => 1,
            'soluser' => "MODDATOS",
            'solpass' => "MODDATOS",
            'ublversion' => "2.1",
            'certificate_path' => "certificates/certificate_1.pem",
            'certificado' => "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDUHbPExymJyOWE
bxY4TlCufbh54zUAonBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8
qwyRaNiIGTsqrSSshMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6
wQ+paBhobLFFgkul4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnlt
bTytNN5j7HBq0sWNvduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzB
Erhme9d6DM7SXY44GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I
18yGrcfRAgMBAAECggEADoQd2lia4iAKfP6xMZdCdD6MUmMXLHzxXIlXifDpb5aS
sokmv7M57tzrobEMMQZ91LO3KqUq03SE1oQKLyVStDWt0+TXfqrz5eK8jbAuy0FG
7Hjy3qmpIk349rcHxrd5pfXXPDOEDUA/m7v8m2ZRTUwq8YvSK37l72in4j7HqeJR
HvFbf/G1GqRpyKQO8aRenPmtE4gD9JVIRFIj6tNaSvBzRpnDTGDpYUriOISic3WJ
YMHr2ANM2hKTz2YQG7JmRvwGR1zULTLNyoThLFtP6MTOgq04zfWB55ZLveO8JCww
HxuK85+k5MQ4GSu1nUe+HLxS7uZ5625w7ZB+t42iAQKBgQD69+DV3xL1R7XYckQ6
TZ6MG8aZYOPqIMEvLyThUGvc6afz3aPhn7494I+jmBqK9P3juVG0RG1MS84mwpG2
mg9qwzY213OQvasdbi/KFN8kMdt7AYu5IJ0ISHCGv3fMXi3+mOD6MlG3BMsngNow
6uml2H0z8Pv1FVqooygP0uNycQKBgQDYXmkcqWnCtnzwh1fCKTII0GkWCE8RJNXv
6N52Im9T4hvys9LT00YCJ6ma2EWpSflpLkreDj71BVPVTh5TFUTk9M4xvjLDdcLQ
E27oFWxIMmeX/2lZnoS6/d2tm++Zwi3rXA6N0zVENzFfruPVBeOAaFfP5L1KtKRj
4uE1bAWbYQKBgQCHMZDEpW6pAwBKoQNwBPAruaq6ZR9huFNY/6R2W8Q/NP9stzDZ
EhyBaL73+bASuvcp/WKuIU5fk1ZyOs4T99nmQVKrKFTw27uaFwlXavbpoJIDKUoD
aDYviBZWAD6gsPtF80T+gqzSUpq9pQPk5icHWB/aIy8XT3GO9pVWMNylgQKBgCCi
lN4i23XoCo5JC76YchiMPt144VwnnzExgaR16y7O0wJXhzw2CMA4dUeKyW8QXlM0
DUzS/0H7zLpGryI++gZCunscQhHjSEAUPk05NfzpxWBSwPQoicKemfoepBQgCscO
Oo+/xLAGVyckfO7blYX/twb/bGHBP25lgSyKn4nhAoGACvOKOL9vyziaLeISY85f
jG1TfeCKG7zsbw95Oy4qfccpSUUgLFuR35A56G0OAc7GNXqrTZ6UjrAJltT5bG+J
u5grbeJ4i1pF/6xoh/pjtfWLUUbsghgRqCqv0z5YemopXTEpVE/vPPC2JhZHfTVO
nnk/MZT7Cwl87tYexykKDbc=
-----END PRIVATE KEY-----
-----BEGIN CERTIFICATE-----
MIIFCDCCA/CgAwIBAgIJAMwye7towTY2MA0GCSqGSIb3DQEBCwUAMIIBDTEbMBkG
CgmSJomT8ixkARkWC0xMQU1BLlBFIFNBMQswCQYDVQQGEwJQRTENMAsGA1UECAwE
TElNQTENMAsGA1UEBwwETElNQTEYMBYGA1UECgwPVFUgRU1QUkVTQSBTLkEuMUUw
QwYDVQQLDDxETkkgOTk5OTk5OSBSVUMgMjA2MDkyNzgyMzUgLSBDRVJUSUZJQ0FE
TyBQQVJBIERFTU9TVFJBQ0nDk04xRDBCBgNVBAMMO05PTUJSRSBSRVBSRVNFTlRB
TlRFIExFR0FMIC0gQ0VSVElGSUNBRE8gUEFSQSBERU1PU1RSQUNJw5NOMRwwGgYJ
KoZIhvcNAQkBFg1kZW1vQGxsYW1hLnBlMB4XDTIzMDUyNTE0NDIyMVoXDTI1MDUy
NDE0NDIyMVowggENMRswGQYKCZImiZPyLGQBGRYLTExBTUEuUEUgU0ExCzAJBgNV
BAYTAlBFMQ0wCwYDVQQIDARMSU1BMQ0wCwYDVQQHDARMSU1BMRgwFgYDVQQKDA9U
VSBFTVBSRVNBIFMuQS4xRTBDBgNVBAsMPEROSSA5OTk5OTk5IFJVQyAyMDYwOTI3
ODIzNSAtIENFUlRJRklDQURPIFBBUkEgREVNT1NUUkFDScOTTjFEMEIGA1UEAww7
Tk9NQlJFIFJFUFJFU0VOVEFOVEUgTEVHQUwgLSBDRVJUSUZJQ0FETyBQQVJBIERF
TU9TVFJBQ0nDk04xHDAaBgkqhkiG9w0BCQEWDWRlbW9AbGxhbWEucGUwggEiMA0G
CSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDUHbPExymJyOWEbxY4TlCufbh54zUA
onBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8qwyRaNiIGTsqrSSs
hMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6wQ+paBhobLFFgkul
4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnltbTytNN5j7HBq0sWN
vduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzBErhme9d6DM7SXY44
GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I18yGrcfRAgMBAAGj
ZzBlMB0GA1UdDgQWBBShW9h2j1hnFWmHL+95E8qbgMHlwDAfBgNVHSMEGDAWgBSh
W9h2j1hnFWmHL+95E8qbgMHlwDATBgNVHSUEDDAKBggrBgEFBQcDATAOBgNVHQ8B
Af8EBAMCB4AwDQYJKoZIhvcNAQELBQADggEBABWmSUiUwKCR+E//0BBCngo3vT3b
J13diCsoPOIcWzRQqE+qQ+pbBwXISke5w0gv6+gV/E/r8yiNqwuJnoM1/5jyFe4j
mF2gIgL0kpiWtnkrT4qn24Y5t/FuQKJtbZx4ec0Uh6n7NzmUoTjm2tP42IqhLQSn
GhWXXnXxh9XGjeVc7SdCIsyvAQ+CbTXJPvIfwTpTtg500NOQaGEIP3lBd5dNLcEp
sErwCa4Ln2Hob2wSXeA3FX8qutkHhiVyGAxaLsy2aW5xVBeR4G24WAYtnjiARYTm
Q03NoAh6oA46zA1LzaF+lpcIPbqNAdb4B4gJ0os+mCgwXx8DkEMSSZvWUMI=
-----END CERTIFICATE-----
",
        ]);




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
        $tc = Tipodecambio::create([
            'valorventa' => 3.7,
            'valorcompra' => 3.6,
            //'fecha' => Carbon::now(),
            'fecha' => Carbon::now()->format('Y-m-d H:i:s'),
            'currency_id' => 1,
            'company_id' => 2,

        ]);


        //creando local principal de company
        $localx = Local::create([
            'name' => 'local secundario',
            'company_id' => $company2->id,
        ]);

        //creando posicion o profesion o cargo
        $positionx = Position::create([
            'name' => 'Administrador',
            'company_id' => $company2->id,
        ]);
        /*         $positionseller = Position::create([
    'name' => 'Vendedor',
    'company_id' => $company->id,
]); */


        //creando usuario admin
        $adminx = User::create([
            'name' => 'Flor',
            'email' => 'flor@ticomperu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $adminx->assignRole($adminRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av mariategui 1731',
            'movil' => '996929470',
            'dni' => '11133423',
            'gender' => 1,
            'user_id' => $adminx->id,
            'local_id' => $localx->id,
            'position_id' => $positionx->id,
            'company_id' => $company2->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);
    }
}
