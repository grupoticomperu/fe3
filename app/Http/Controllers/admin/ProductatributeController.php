<?php

namespace App\Http\Controllers\admin;

use App\Models\Productfamilie;
use App\Models\Productatribute;
use App\Http\Controllers\Controller;
use App\Models\Image as ModelsImage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use App\Models\Local;
use App\Models\Localproductatribute;

class ProductatributeController extends Controller
{
    public $locales;
    public function pricesale(Productfamilie  $product){
    //public function pricesale($product){
        //aqui no se porque razon no funciona el modelbinding
        //era porque se redefinio la url como rutas amigables
        //llama a la vista para modificar precios
        //dd("ok");
        //dd($product);
        //$product = Productfamilie::find($product);
        //dd($product);
        return view('admin.productatributes.pricesale', compact('product'));
    }

    public function pricepurchase(Productfamilie $product){
        //llama a la vista para modificar precios
        return view('admin.productatributes.pricepurchase', compact('product'));
    }

    public function pricewholesale(Productfamilie $product){
        //llama a la vista para modificar precios
        return view('admin.productatributes.pricewholesale', compact('product'));
    }

    public function delete(Productfamilie $product){
        //llama a la vista para eliminar productos
        return view('admin.productatributes.delete', compact('product'));
    }

    public function codigo(Productfamilie $product){
        //llama a la vista para modificar codigos
        return view('admin.productatributes.codigo', compact('product'));
    }

    //cambia precios de venta de productatributes
    public function updatepricesale(Request $request){
       $locales = Local::all();
       $val = $request;
       $valores = collect($val);//convertimos a collección
       $valores->pull('_token');//quita el registro que tiene el key (_token)

        foreach ($valores as $key => $value) {
                $productatribute = Productatribute::find($key);
                $productatribute->update([
                    'pricesale' => $value
                ]);
                foreach ($locales as $local) {//guardamos precio de venta en cada local
                    $productatributelocal = Localproductatribute::where('local_id',$local->id)->where('productatribute_id', $productatribute->id);
                    $productatributelocal->update([
                        'pricesale' => $value
                    ]);
                    //$local->productatributes()
                }
        }
        return Redirect::back()->with('flash', 'Los precios de venta fueron gravados con éxito');
       // return view('admin.productatributes.index', compact('product'));
    }

    //cambia precios de compra productatributes
    public function updatepricepurchase(Request $request){
        $val = $request;
        $valores = collect($val);//convertimos a collección
        $valores->pull('_token');//quita el registro que tiene el key (_token)

         foreach ($valores as $key => $value) {
                 $productatribute = Productatribute::find($key);
                 $productatribute->update([
                     'pricepurchase' => $value
                 ]);
         }
         return Redirect::back()->with('flash', 'Los precios de compra fueron gravados con éxito');
        // return view('admin.productatributes.index', compact('product'));
     }


    //cambia precios de venta al por mayor productatributes
    public function updatepricewholesale(Request $request){
        $val = $request;
        $valores = collect($val);//convertimos a collección
        $valores->pull('_token');//quita el registro que tiene el key (_token)

         foreach ($valores as $key => $value) {
                 $productatribute = Productatribute::find($key);
                 $productatribute->update([
                     'pricewholesale' => $value
                 ]);
         }
         return Redirect::back()->with('flash', 'Los precios de venta al por mayor fueron gravados con éxito');
        // return view('admin.productatributes.index', compact('product'));
     }

    //cambia codigos de productatributes
    public function updatecodigo(Request $request){
        $val = $request;
       $valores = collect($val);
       $valores->pull('_token');//quita el registro que tiene el key _token

        foreach ($valores as $key => $value) {
            $productatribute = Productatribute::find($key);
            $productatribute->update([
                'codigo' => $value
            ]);

        }
        return Redirect::back()->with('flash', 'Los Códigos fueron gravados con éxito');
       // return view('admin.productatributes.index', compact('product'));
    }


    public function addimage(Productatribute $productatribute){
        return view('admin.productatributes.addimage', compact('productatribute'));
    }

    public function addphoto(){
        return view('admin.productatributes.addphoto');
    }

    public function storephoto(Request $request){
        //return $request;
        $imagen = $request-> file('file');
        return response()->json(['imagen' => $imagen->extension()]);
        return $imagen;
        return response()->json(['imagen'=>$imagen->extension()]);
        //return "Cargando imagen";//quitar comentario cuando carga la imagen
    }

    public function storeimage(Request $request, Productatribute $productatribute){
        //return $productatribute;//quitar comentario cuando carga la imagen
       // $imagen = $request->all();
        $imagen = $request->file('file');
        //return $imagen;
        // return response()->json(['imagen' => $imagen->extension()]);
        //return $imagen;
        $nombreImagen = Str::uuid().".".$imagen->extension();
       //$nombreImagen = Str::uuid()."."."jpg";
       //return $nombreImagen;
        $imagenServidor = Image::make($imagen);
       // return $imagenServidor;
        $imagenServidor->fit(500, 500);

        $imagenPath = public_path('img/productsatribute') . '/' . $nombreImagen;
        $imagenServidor -> save($imagenPath);

       // return response()-> json(['imagen' => $nombreImagen ]);

        ModelsImage::create([
            //'url' => request()->file('file')->store('productsatribute'), //usar esto cuando guardamos sin storage link directo en la carpeta publica public en img
            'url' => 'img/productsatribute/'.$nombreImagen,
            'productatribute_id' => $productatribute->id,
            //'url' => "hola",
            //en las vistas cambiar ya no funciona Storage::url()

        ]);

       // return Redirect::back()->with('flash', 'Imagenes guardadas con ëxito');
      // return redirect()->route('admin.productatribute.addimage', $productatribute);
      // return view('admin.productatributes.addimage', compact('productatribute'));

    }


    public function dropzone(){
        return view('admin.productatributes.dropzone');
    }

    public function dropzoneok(Request $request){
        return "hola";//carga la imagen
    }


    public function destroyimage(ModelsImage $photo){

        $photo->delete();
        return back()->with('flash','Imagen Eliminado');

    }




    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productatribute  $productatribute
     * @return \Illuminate\Http\Response
     */
    public function show(Productatribute $productatribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productatribute  $productatribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Productatribute $productatribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productatribute  $productatribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productatribute $productatribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productatribute  $productatribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productatribute $productatribute)
    {
        $product = $productatribute->productfamilie->id;
       // return $product;
        $productatribute->delete();
        return redirect()->route('admin.productatribute.delete', $product)->with('eliminar','ok');
    }
}
