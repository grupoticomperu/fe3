<?php

namespace App\Http\Livewire\Admin;

use Livewire\Request;
use Livewire\Component;
use App\Models\Atribute;
use Illuminate\Support\Str;
use App\Models\Groupatribute;
use App\Models\Productfamilie;
use App\Models\Productatribute;
use Illuminate\Support\Collection;
//use Illuminate\Http\Request;
use App\Models\Local;

class ProductcompuestoCreate extends Component
{
    public $atributesphp=[];
    public $i, $j;
    public $product;
    public $locales;//para guardar los productos en cada local
    //$atributes[][];

    public $createForm = [
        'atributes' => [],
    ];



    public function mount(Productfamilie $product){
        $this->product = $product;//recibimos producto creado del popup
        $this->locales = Local::all();

        $this->i=0;
        $this->j=0;
    }

    public function render()
    {
        //if(session('idCarrito')=='xyz') return redirect('/');

        //if(!$this->product) return view('category.listd');
        //$categories = Category::all();
        $groupatributes = Groupatribute::all();//todo los grupo de atributos como talla, color, volumen, etc


        //dd($groupatributes);
       // $atributes = $groupatributes->atributes();
        //return view('miempresa.miscategoriass', compact('user', 'categories'));
       // dd($atributes);
        //dd(($this->createForm['atributes']));

        return view('livewire.admin.productcompuesto-create', compact('groupatributes'));
    }

    public function crear(){
        session(['idCarrito' => 'xyz']);
       // if(!$request->ajax()) return redirect('/');//no funciona quiero evitar que presionen botn atras

        $groupatributes = Groupatribute::pluck('name','id');
        //dd($groupatributes);
        /*foreach ($groupatributes as $key => $value) {

        } */


       // $atributes = $groupatributes->atributes();
        //return view('miempresa.miscategoriass', compact('user', 'categories'));
        //dd($this->atributes);
        //dd($this->i);
        //dd(count(collect($this->atributesphp)->all()));
       // dd(collect($this->atributesphp)->all());
       //datos tiene lo escogido
       $datos = $this->atributesphp;
        //cuando guarda el producto sin atributos
       if($datos==NULL){
            $productatribute = Productatribute::create([
                'codigo' => $random = Str::random(10),
                'pricesale'=>NULL,
                'state' => 1,
                //'slug' => $random = Str::random(15),
                'slug' => Str::slug($this->product->name),
                //'name' => $this->product->name,
                'productfamilie_id' => $this->product->id,
                'titlegoogle' => $this->product->name,
                'descriptiongoogle' => $this->product->name,
                'keywordsgoogle' => $this->product->name,
            ]);
            //$productatribute->atributes()->attach($res[$i]);
            $productatribute->atributes()->sync(1,1);

            $this->product->save();

           return redirect()->route('admin.productatribute.pricesale', $this->product->id);

       }


       // $datee = collect($datos[0]);
        //dd($datos);
       // $j=0;
        $p=1;//esta variable indicara la cantidad de combinaciones de productos
        foreach ($groupatributes as $keyga => $valuega) {
                //$valuega tiene Tallas Colores, $keyga tiene 1,2
                $i=0;//inicia el contador para acumular la cantidad de tallas, colores, ..  escogidos
               // echo $valuega;
                $valores = $valuega;//en $valores guardo Tallas, Colores, ...
                $$valores=[];//se genera $Tallas[] $Colores[] $volumen[] ....
            foreach ($datos as $keya=>$valuea) {//datos tiene todo lo escogido para generar el producto
                //$keya tiene 0,1,2  $valuea tiene "['Tallas' => 'S']"  ahora tiene "['Tallas' => '1']"
                $valuea = substr($valuea,1,-1);//quitamos "[  y ]"  queda 'Tallas' => 'S'  ahora queda 'Tallas' => '1'
                $gaa = explode('=>', $valuea); //convertimos en array  ['Tallas','S']  ahora   ['Tallas','1']
                if ($gaa[0] == $valuega){//comparamos para ver cuantas veces se repite el grupo atributo
                    $grupoatributosescogidos[] = $valuega;//ahora quitaremos los repetidos osea si hay Tallas, Tallas, Tallas, Colores, Colores deberia estar Tallas,Colores
                    $grupoatributosescogidosfinal = array_unique($grupoatributosescogidos);//grupoatributosescogidosfinal  acumula los grupos de atributos Tallas, colores,..sin repetirse
                    $i = $i+1;//guarda el numero de tallas, colores, ... escogidos(osea si en tallas escogiste s,m,l guarda 3)
                    //$gx[$valuega]=$gaa[1];no sirve, al poner nombre a la clave se vuelve multidimensional
                    //$gx[][$valuega]=$gaa[1];
                    $$valores[]=$gaa[1];//realmente esta guardando $Tallas[]=[s,m,l] $Colores[]=[rojo,verde,azul]...pero ahora $Tallas[]=[1,2,3] $Colores[]=[4,5,6].
                    //$gx[$valuega][]=$gaa[1];
                }
            }
            //al salir del bucle si $i=0 significa que el grupo atributo no tiene nada seleccionado
            //ejemplo si solo escojo (tallas = s,m,l) (colores rojo,azul) al entrar a volumen sin seleccion i=0
            //$i acumula 3 luego 2
            if($i!=0){//validamos para que no cuente grupos de atributos no escogidos
                $p=$p*$i;//$p seria 6

            }


            //$ga[$j]=$i;


           // $j=$j+1;
        }
       // echo $p;

        //dd($volumen);
        //dd($grupoatributosescogidosfinal[0]);
        //dd($gx);
       // dd($gx[0]["Colores"]);
        //dd($gx["Tallas"][0]);

        //$ver = $datos[1];
        //dd($item);
       // $value = $datos->get('Tallas');

    //
        foreach ($grupoatributosescogidosfinal as $escogidos) {
            // dd($$escogidos);
            $gaaa[]=$escogidos;//$gaaa['Tallas','Colores']
        }
        //dd($gaaa[0]);

        $fa = count($gaaa);

        if($fa == 1){
            $noma= $gaaa[0];//$gaaa[0]=Tallas
            $res = $$noma;//res devuelve tantos valores como p osea si p es 4, entonces res tiene 4 valores, y cada valor es un array que tiene 2 datos ejemplo (s,rojo) o (1,8)
            //dd($res);
            //dd($res[0]);
        }



        if($fa == 2){
            $noma= $gaaa[0];//$gaaa[0]=Tallas
            $nomb= $gaaa[1];//$gaaa[1]=Colores
            $collection=collect($$nomb);//$$noma =$Tallas pero $Tallas=[1,2,3]   ver linea 82
            $matrix=$collection->crossJoin($$noma);//$$nomb =$Colores pero $Colores=[4,5,6]   ver linea 82
            $res = $matrix->all();//res devuelve tantos valores como p osea si p es 4, entonces res tiene 4 valores, y cada valor es un array que tiene 2 datos ejemplo (s,rojo) o (1,8)
            //dd($res);
            //dd($res[0]);
        }

        if($fa == 3){
            $noma= $gaaa[0];
            $nomb= $gaaa[1];
            $nomc= $gaaa[2];

            $collection=collect($$noma);
            $matrix=$collection->crossJoin($$nomb, $$nomc);
            $res = $matrix->all();

        }

        if($fa == 4){
            $noma= $gaaa[0];
            $nomb= $gaaa[1];
            $nomc= $gaaa[2];
            $nomd= $gaaa[3];

            $collection=collect($$noma);
            $matrix=$collection->crossJoin($$nomb, $$nomc, $$nomd);
            $res = $matrix->all();
        }

        //generamos el producto, p y res tiene la misma cantidad, si p=4  restiene 4 registros y cada registro 2 datos

        for ($i=0; $i < $p; $i++) {
            //$cadena = implode('-', $res[$i]);
           /* con este codigo generamos el slug personalizado de cada producto */
            $org = $res[$i];
            $org = collect($org);
            $cadena = "";
            foreach ($org as $key => $value) {
                $atribute = Atribute::find($value);
                $atributename = $atribute->name;
                $groupatribute = $atribute->groupatribute->name;
                $cadena = $cadena ." ".$groupatribute ." ". $atributename;
            }
            /* fin de con este codigo generamos el slug personalizado de cada producto */

            $productatribute = Productatribute::create([
                'codigo' => $random = Str::random(10),
                'pricesale'=>NULL,
                'state' => 1,
                //'slug' => $random = Str::random(15),
                'slug' => Str::slug($this->product->name." ".$cadena),
                //'name' => $this->product->name,
                'productfamilie_id' => $this->product->id,
                'titlegoogle' => $this->product->name." ".$cadena,
                'descriptiongoogle' => $this->product->name." ".$cadena,
                'keywordsgoogle' => $this->product->name." ".$cadena,
            ]);

            //$productatribute->atributes()->attach($res[$i]);
            $productatribute->atributes()->sync($res[$i]);
            //aqui gurdamos los productos en cada local no uso sync porque elimina anteriores y solo guarda el ultimo
            foreach ($this->locales as $local) {
                $local->productatributes()->attach([
                    $productatribute->id =>['stock'=>0]

                ]);
            }
        }



       // dd(($this->createForm['atributes']));

       /* $this->product->update([
        'flag' => 1
       ]); */
       //no cambia el flag por eso use save

      // $this->product->flag = 1;
       $this->product->save();


       //return redirect()->route('productcompuesto.list', $this->product->id);
       //return redirect()->route('admin.productatribute.pricesale', $this->product->id);
       return redirect()->route('admin.productatribute.pricesale', $this->product->slug);

    }



}
