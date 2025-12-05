<?php
//use App\Models\Comprobante;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\BrandList;
use App\Http\Livewire\Admin\LocalEdit;
use App\Http\Livewire\Admin\LocalList;
use App\Http\Livewire\Admin\LocaldEdit;
use App\Http\Livewire\Admin\ModeloList;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Admin\CompanyEdit;
use App\Http\Livewire\Admin\LocalCreate;
use App\Http\Livewire\Admin\ProductEdit;
use App\Http\Livewire\Admin\ProductList;
use App\Http\Livewire\Admin\ResumenList;
use App\Http\Livewire\Admin\CategoryList;
use App\Http\Livewire\Admin\CustomerEdit;
use App\Http\Livewire\Admin\CustomerList;
use App\Http\Livewire\Admin\LocalCreated;
use App\Http\Livewire\Admin\ProductListd;
use App\Http\Livewire\Admin\ShipmentEdit;
use App\Http\Livewire\Admin\CategoryEditd;
use App\Http\Livewire\Admin\CategoryListd;
use App\Http\Livewire\Admin\InventoryList;
use App\Http\Livewire\Admin\ProductCreate;
use App\Http\Livewire\Admin\ReceptionEdit;
use App\Http\Livewire\Admin\CustomerCreate;
use App\Http\Livewire\Admin\InventoryList2;
use App\Http\Livewire\Admin\PermissionList;
use App\Http\Controllers\admin\BoletaReport;
use App\Http\Livewire\Admin\CategoryCreated;
use App\Http\Livewire\Admin\CategoryCreatet;
use App\Http\Livewire\Admin\ComprobanteList;
use App\Http\Livewire\Admin\InventoryListdos;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Livewire\Admin\ComprobanteCreate;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\LocalController;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\BoletaController;
use App\Http\Livewire\Admin\NotadecreditoCreate;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ResumenController;
use App\Http\Livewire\Admin\GuiaderemisionCreate;
use App\Http\Livewire\Admin\InventorygeneralList;
use App\Http\Livewire\Admin\ProductcompuestoEdit;
use App\Http\Livewire\Admin\ProductcompuestoList;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ShipmentController;
use App\Http\Controllers\admin\ShoppingController;
use App\Http\Controllers\admin\ReceptionController;
use App\Http\Livewire\Admin\InventorytemporaryList;
use App\Http\Livewire\Admin\ProductcompuestoCreate;
use App\Http\Livewire\Admin\ProductfamilieCreateaa;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\UsersRolesController;
use App\Http\Livewire\Admin\ProductcompuestoCreatea;
use App\Http\Controllers\admin\ComprobanteController;
use App\Http\Controllers\admin\ConfigurationController;
use App\Http\Controllers\Admin\GuiaPdfController;
use App\Http\Controllers\admin\ProductfamilieController;
use App\Http\Controllers\admin\ProductatributeController;
use App\Http\Controllers\admin\UsersPermissionsController;
use App\Http\Livewire\Admin\ConductorCreate;
use App\Http\Livewire\Admin\ConductorEdit;
use App\Http\Livewire\Admin\ConductorList;
use App\Http\Livewire\Admin\GuiaList;
use App\Http\Livewire\Admin\LocalproductatributestockList;
use App\Http\Livewire\Admin\LocalproductatributestocktotalesList;
use App\Http\Livewire\Admin\PuntodepartidaCreate;
use App\Http\Livewire\Admin\PuntodepartidaEdit;
use App\Http\Livewire\Admin\PuntodepartidaList;
use App\Http\Livewire\Admin\TransportistaCreate;
use App\Http\Livewire\Admin\TransportistaEdit;
use App\Http\Livewire\Admin\TransportistaList;
use App\Http\Livewire\Admin\VehiculoCreate;
use App\Http\Livewire\Admin\VehiculoEdit;
use App\Http\Livewire\Admin\VehiculoList;

//Route::get('/', [HomeController::class, 'home'])->name('admin.home');
Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');

Route::post('/marcas/import',[BrandController::class,'importStore'])->name('brand.importstore');

Route::get('/marcas/reportpdf',[BrandController::class,'pdfReport'])->name('brand.reportpdf');

Route::get('/categories', CategoryList::class)->name('category.list');
Route::get('/modelos', ModeloList::class)->name('modelo.list');
Route::get('/marcas', BrandList::class)->name('brand.list');

Route::get('/locales', LocalList::class)->name('local.list');
Route::get('/local/create', LocalCreated::class)->name('local.create');
Route::get('/local/edit/{local}', LocalEdit::class)->name('local.edit');
Route::get('/locald/edit/{local}', LocaldEdit::class)->name('locald.edit');//alternativo
//Route::get('local/create', [LocalController::class, 'create'])->name('admin.local.create');
Route::get('/boletaprueba', [BoletaReport::class,'generarPDF'])->name('admin.boletaprueba');


//Route::get('/empezarinventarioinicial', InventoryList::class)->name('inventory.list');
Route::get('/inventarioinicial', InventoryList::class)->name('inventory.list');//lista los inventarios
/* no usaremos porque lo controlaresmos con primarykey de laravel */
Route::get('/inventariogeneral', InventoryListdos::class)->name('inventory.listdos');//lista los inventarios dos
Route::get('/inventariog', InventorygeneralList::class)->name('inventorygeneral.lis');//lista los inventarios dos
Route::get('/listadeinventarios', InventoryList2::class)->name('inventory.list2');//lista los inventarios dos
Route::get('/inventariotemporallist/{inventory}', InventorytemporaryList::class)->name('inventorytemporary.list');//lista los inventarios
Route::get('/stockdeproductos/{local}', LocalproductatributestockList::class)->name('localproductatributestock.list');//lista de stock local product atribute stock
Route::get('/stockdeproductostotales/{productatribute_id}', LocalproductatributestocktotalesList::class)->name('localproductatributestocktotales.list');//lista de stock local product atribute stock
//compra de mercaderias shopping
Route::resource('shopping', ShoppingController::class)->names('admin.shopping');
Route::get('sale', [SaleController::class, 'index'])->name('admin.sale.index');
Route::get('sale/create', [SaleController::class, 'create'])->name('admin.sale.create');

Route::get('comprobante', ComprobanteList::class)->name('admin.comprobante.list');
Route::get('guias', GuiaList::class)->name('admin.guia.list');

//Route::get('comprobante', ComprobanteList::class, 'create')->name('admin.comprobante.list');
Route::get('download-xml/{comprobanteId}', ComprobanteList::class)->name('download-xml');
Route::get('comprobante/create', [ComprobanteController::class, 'create'])->name('admin.comprobante.create');
Route::get('comprobante/createdos', [ComprobanteController::class, 'createdos'])->name('admin.comprobante.createdos');
Route::get('comprobante/createtres', [ComprobanteController::class, 'createtres'])->name('admin.comprobante.createtres');
Route::get('comprobante/createcuatro', [ComprobanteController::class, 'createcuatro'])->name('admin.comprobante.createcuatro');
Route::get('comprobante/createcinco', [ComprobanteController::class, 'createcinco'])->name('admin.comprobante.createcinco');
Route::get('comprobante/createrapido', [ComprobanteController::class, 'createrapido'])->name('admin.comprobante.createrapido');

Route::get('/comprobantes/{comprobante}/xml', [ComprobanteList::class, 'downloadXml'])->name('download-xml');    

Route::get('notadecredito/create/{id}', NotadecreditoCreate::class)->name('admin.notadecredito.create');
Route::get('guiaderemision/create/{id}', GuiaderemisionCreate::class)->name('admin.guiaderemision.create');

Route::get('guiaderemision/pdf/{id}/{format}', [GuiaPdfController::class, 'print'])->name('admin.guiaderemision.pdf');


Route::get('resumen', ResumenList::class)->name('admin.resumen.list');
Route::get('resumen/create', [ResumenController::class, 'create'])->name('admin.resumen.create');
//Route::get('resumen/createe', [ResumenController::class, 'createe'])->name('admin.resumen.create');

//envio de mercaderias entre locales
//php artisan make:controller admin/ShipmentController -r -m Shipment
Route::resource('shipment', ShipmentController::class)->names('admin.shipment');
Route::get('/shipments/{shipment}', ShipmentEdit::class)->name('shipment.edit');
//php artisan make:controller admin/ReceptionController
//Route::resource('reception', ReceptionController::class)->names('admin.reception');
Route::get('reception', [ReceptionController::class, 'index'])->name('admin.reception.index');//lista recepciones para conformar
Route::get('/receptions/{reception}', ReceptionEdit::class)->name('reception.edit');



//Route::get('categories', [CategoryController::class, 'index']);
Route::get('categoriess', CategoryListd::class)->name('category.listd');
Route::get('categories/{categoryId}', CategoryEditd::class)->name('category.editd');
Route::get('/category/create', CategoryCreated::class)->name('category.created');
Route::get('/category/createe', CategoryCreatet::class)->name('category.createt');
Route::get('categories4', [CategoryController::class, 'indexxd'])->name('category.list4');

Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('products', ProductListd::class)->name('product.list');
Route::get('productos/{productId}', ProductEdit::class)->name('admin.product.edit');
Route::get('products/create', ProductCreate::class)->name('admin.product.create');
Route::get('/products/reportpdf',[ProductController::class,'pdfReport'])->name('product.reportpdf');
Route::post('/products/import',[ProductController::class,'importStore'])->name('product.importstore');

Route::get('customers', CustomerList::class)->name('customer.list');
Route::get('customers/{customerId}', CustomerEdit::class)->name('admin.customer.edit');
Route::get('customer/create', CustomerCreate::class)->name('admin.customer.create');


Route::get('transportistas', TransportistaList::class)->name('transportista.list');
Route::get('transportistas/create', TransportistaCreate::class)->name('transportista.create');
Route::get('transportistas/{transportista}/edit',TransportistaEdit::class)->name('transportista.edit');

Route::get('conductors', ConductorList::class)->name('conductor.list');
Route::get('conductors/create', ConductorCreate::class)->name('conductor.create');
Route::get('conductors/{conductor}/edit', ConductorEdit::class)->name('conductor.edit');

Route::get('vehiculos', VehiculoList::class)->name('vehiculo.list');
Route::get('vehiculos/create', VehiculoCreate::class)->name('vehiculo.create');
Route::get('vehiculos/{vehiculo}/edit', VehiculoEdit::class)->name('vehiculo.edit');


Route::get('puntodepartida', PuntodepartidaList::class)->name('puntodepartida.list');
Route::get('puntodepartida/create', PuntodepartidaCreate::class)->name('puntodepartida.create');
Route::get('puntodepartidas/{puntodepartida}/edit',PuntodepartidaEdit::class)->name('puntodepartida.edit');

//Route::get('products', ProductList::class)->name('product.list');
Route::get('productcompuesto/{product}', ProductcompuestoCreate::class)->name('productcompuesto.create');//creamos el producto productatribute
Route::get('productcompuestoedit/{product}', ProductcompuestoEdit::class)->name('productcompuesto.edit');



Route::resource('productatribute', ProductatributeController::class)->names('admin.productatribute');
Route::get('productatributepricesale/{product}', [ProductatributeController::class, 'pricesale'])->name('admin.productatribute.pricesale');
Route::get('productatributepricepurchase/{product}', [ProductatributeController::class, 'pricepurchase'])->name('admin.productatribute.pricepurchase');//lista productos generados para modificar precio de compra
Route::get('productatributepricewholesale/{product}', [ProductatributeController::class, 'pricewholesale'])->name('admin.productatribute.pricewholesale');//lista productos generados para modificar precio de venta al por mayor
Route::get('productatributecodigo/{product}', [ProductatributeController::class, 'codigo'])->name('admin.productatribute.codigo');//lista productos generados para modificar codigo

Route::get('productatributedelete/{product}', [ProductatributeController::class, 'delete'])->name('admin.productatribute.delete');//activa para eliminar productos


Route::get('productatributeaddimage/{productatribute}', [ProductatributeController::class, 'addimage'])->name('admin.productatribute.addimage');//vista para agregar imagenes del productoatribute
Route::get('/productatributeaddphoto', [ProductatributeController::class, 'addphoto'])->name('admin.productatribute.addphoto');//vista para agregar imagenes del productoatribute
Route::post('/productatributestorephoto', [ProductatributeController::class, 'storephoto'])->name('admin.productatribute.storephoto');
Route::post('productatributestoreimage/{productatribute}', [ProductatributeController::class, 'storeimage'])->name('admin.productatribute.storeimage');
Route::delete('productatributedestroyimage/{photo}', [ProductatributeController::class, 'destroyimage'])->name('admin.productatribute.destroyimage');


Route::post('productatributepricepurchase', [ProductatributeController::class, 'updatepricepurchase'])->name('admin.productatribute.updatepricepurchase');//actualiza precios
Route::post('productatributepricesale', [ProductatributeController::class, 'updatepricesale'])->name('admin.productatribute.updatepricesale');//actualiza precios
Route::post('productatributepricewholesale', [ProductatributeController::class, 'updatepricewholesale'])->name('admin.productatribute.updatepricewholesale');//actualiza precios

Route::post('productatributesupdatecodigo', [ProductatributeController::class, 'updatecodigo'])->name('admin.productatribute.updatecodigo');//actualiza codigo


//Route::get('productfamily', ProductfamilieCreateaa::class)->name('productfamilie.createaa');
Route::get('productfamily/{category}', ProductfamilieCreateaa::class)->name('productfamilie.createaa');

Route::get('productcompuestolist/{product}', ProductcompuestoList::class)->name('productcompuesto.list');


Route::get('/xxx', [ProductfamilieController::class, 'create'])->name('admin.create');

Route::get('/dropzone', [ProductatributeController::class, 'dropzone'])->name('admin.dropzone');
Route::post('/dropzone', [ProductatributeController::class, 'dropzoneok'])->name('admin.dropzoneok');

//Route::resource('usuarios', UserController::class)->names('admin.usuarios');
Route::resource('user', UserController::class)->names('admin.user');

Route::put('users/{user}/roles', [UsersRolesController::class, 'update'])->name('admin.user.roles.update')->middleware('role:Admin');
Route::put('users/{user}/permissions', [UsersPermissionsController::class, 'update'])->name('admin.users.permissions.update')->middleware('role:Admin');

Route::resource('role', RoleController::class)->names('admin.role');
Route::get('/permission', PermissionList::class)->name('permission.list');


//Route::resource('configuration', ConfigurationController::class)->only(['edit','update'])->names('admin.configuration')->middleware('permission:update Configuration');
//Route::resource('configuration', ConfigurationController::class)->only(['edit','update'])->names('admin.configuration');
//llamamos en el url por ejemplo  http://fe2.test/admin/configuration/1/edit

Route::get('/company/edit/{id}', CompanyEdit::class)->name('admin.company.edit');
//Route::get('guiaderemision/create/{id}', GuiaderemisionCreate::class)->name('admin.guiaderemision.create');
//terminado CompanyEdit lo borraremos


Route::get('/boletas/{resumen}', [BoletaController::class, 'index'])->name('admin.boletas.index');



Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});

//borrar

Route::get('/update-name2', [DepartmentController::class, 'updateName2']);//para llanar name2 de departments

/* Route::get('existe', function(){
    if (Storage::exists('certificates/certificate_1.pem')) {
        throw new \Exception(' si existe ');
    }
}); */


/* Route::get('/download-xml/{comprobante}', function ($comprobanteId) {
    $comprobante = Comprobante::findOrFail($comprobanteId);
    $xmlPath = $comprobante->factura->xml_path ?? $comprobante->boleta->xml_path ?? $comprobante->ncfactura->xml_path ?? $comprobante->ncboleta->xml_path;

    if (!$xmlPath) {
        abort(404);
    }

    $fileContent = Storage::disk('s3')->get($xmlPath);
    $fileName = basename($xmlPath);

    return response()->streamDownload(function () use ($fileContent) {
        echo $fileContent;
    }, $fileName, [
        'Content-Type' => 'application/xml',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ]);
})->name('download-xml'); */

/* Route::get('/download-xml/{comprobante}', function ($comprobanteId) {
    $comprobante = Comprobante::findOrFail($comprobanteId);
    $xmlPath = $comprobante->factura->xml_path ?? $comprobante->boleta->xml_path ?? $comprobante->ncfactura->xml_path ?? $comprobante->ncboleta->xml_path;

    if (!$xmlPath) {
        abort(404);
    }

    $url = Storage::disk('s3')->temporaryUrl(
        $xmlPath, now()->addMinutes(5)
    );

    return redirect($url);
})->name('download-xml'); */
