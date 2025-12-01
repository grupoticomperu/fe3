<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Atribute;
use App\Models\Groupatribute;
use App\Models\Productfamilie;
use App\Models\Productatribute;
use Illuminate\Support\Str;


class ProductcompuestoEdit extends Component
{
    public $product;
    public $atributesphp=[];
    public $atributesphpback=[];
    public $atributesphpd=[];
    public $isDisabled = false;


    public function mount(Productfamilie $product){

         $this->product = $product;
         $groupatributes = Groupatribute::all();//todo los grupo de atributos como talla, color, volumen, etc
         //$this->atributesphp = categories->pluck('id');
         //$this->atributesphp = $product->productatributes;
         //$this->atributesphp = ['Tallas'=>1, 'Colores'=>5];
         //dd($this->atributesphp);
         //dd($this->product->productatributes);

        //$res = $this->product->productatributes;

        foreach ($this->product->productatributes as $productatribute) {

            foreach($productatribute->atributes as $atribute){
                $name = $atribute->groupatribute->name;
               // $arraygrupoatributos[] = $atribute->groupatribute->name;//poner id para que guarde el id de tallas, colores, ...
                $id = $atribute->id;
                $this->atributesphp[] = "[$name=>$id]";
                $this->atributesphpback[] = "[$name=>$id]";

               // $$name[]=$id;

/*                 if($this->atributesphp[0]){
                    $this->isDisabled = true;
                } */

                $arrayatributos[] = $id;//acumulo los id para deshabilitar el checkbox

                $this->atributesphpd = array_unique($arrayatributos); // lo paso los valores a atributesphpd y hacemos que no se repita los valores


                //value="[{{$groupatribute->name}}=>{{$atribute->id}}]"
            }
        }

       // $this->atributesphp = array_unique($this->atributesphp);

       // $arraygrupoatributosd = array_unique($arraygrupoatributos);
       // $arrayatributosd = array_unique($arrayatributos);

        //dd($arraygrupoatributosd);
        //dd($arrayatributos);

        //dd($this->atributesphpd );


        //dd($this->atributesphp[0]);

         //foreach ( $groupatributes as $groupatribute)
            /*foreach ($groupatributes as $groupatribute) {
            foreach($groupatribute->atributes as $atribute ){
                if ($atribute->id) {
                    $this->atributesphp = [$groupatribute->name => $atribute->id];
                }

             }
            } */

     }

/*      public function updatedAtributesphpd(){

        if($this->atributesphpd)
            $this->isDisabled = true;
        else
            $this->isDisabled = false;
     } */





    public function render()
    {
        $groupatributes = Groupatribute::all();//todo los grupo de atributos como talla, color, volumen, etc
        return view('livewire.admin.productcompuesto-edit', compact('groupatributes'));


    }



    public function crear(){

        /* primero hacemos en  atributesphp */

        $groupatributes = Groupatribute::pluck('name','id');
        $datos = array_unique($this->atributesphp);
        $datos2 = array_unique($this->atributesphpback);

        if(count($datos2)==0){//modificamos cuando no escogio ningun atributo, sera como crear nuevo
            $datos = $this->atributesphp;
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
            }


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
               // dd($res);
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
                $productatribute = Productatribute::create([
                    'codigo' => $random = Str::random(10),
                    'price'=>100,
                    'state' => 1,
                    'productfamilie_id' => $this->product->id
                ]);

                $productatribute->atributes()->attach($res[$i]);
                //$productatribute->atributes()->sync($res[$i]);
            }


           $this->product->flag = 1;
           $this->product->save();

           return redirect()->route('productcompuesto.list', $this->product->id);



            /*termina*/
        }else{//si datos2 no es vacio


            if(count($datos)==count($datos2)){
                // dd("ok");//no hubo cambio
                return;
             }

            // dd($datos);
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
             }



             foreach ($grupoatributosescogidosfinal as $escogidos) {
                 // dd($$escogidos);
                 $gaaa[]=$escogidos;//$gaaa['Tallas','Colores']
             }
             //dd($gaaa[0]);

             $fa = count($gaaa);

             if($fa == 1){
                 $noma= $gaaa[0];//$gaaa[0]=Tallas, $noma = Tallas y $$noma =$Tallas
                 $res = $$noma;//res devuelve tantos valores como p osea si p es 4, entonces res tiene 4 valores, y cada valor es un array que tiene 2 datos pero en este caso solo tiene 1 dato
                 //dd($res);
                 //dd($res[0]);
             }



             if($fa == 2){
                 $noma= $gaaa[0];//$gaaa[0]=Tallas
                 $nomb= $gaaa[1];//$gaaa[1]=Colores
                 //dd($$noma);
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




             /* hacemos de atributesphpback*/


             //$datos = array_unique($this->atributesphpback);

             // dd($datos);
             $pd=1;//esta variable indicara la cantidad de combinaciones de productos
             foreach ($groupatributes as $keyga => $valuega) {
                     //$valuega tiene Tallas Colores, $keyga tiene 1,2
                     $i=0;//inicia el contador para acumular la cantidad de tallas, colores, ..  escogidos
                     // echo $valuega;
                     $vvalores = $valuega;//en $valores guardo Tallas, Colores, ...
                     $$vvalores=[];//se genera $Tallas[] $Colores[] $volumen[] ....
                 foreach ($datos2 as $keya=>$valuea) {//datos tiene todo lo escogido para generar el producto
                     //$keya tiene 0,1,2  $valuea tiene "['Tallas' => 'S']"  ahora tiene "['Tallas' => '1']"
                     $valuea = substr($valuea,1,-1);//quitamos "[  y ]"  queda 'Tallas' => 'S'  ahora queda 'Tallas' => '1'
                     $gaa = explode('=>', $valuea); //convertimos en array  ['Tallas','S']  ahora   ['Tallas','1']
                     if ($gaa[0] == $valuega){//comparamos para ver cuantas veces se repite el grupo atributo
                         $ggrupoatributosescogidos[] = $valuega;//ahora quitaremos los repetidos osea si hay Tallas, Tallas, Tallas, Colores, Colores deberia estar Tallas,Colores
                         $ggrupoatributosescogidosfinal = array_unique($ggrupoatributosescogidos);//grupoatributosescogidosfinal  acumula los grupos de atributos Tallas, colores,..sin repetirse
                         $i = $i+1;//guarda el numero de tallas, colores, ... escogidos(osea si en tallas escogiste s,m,l guarda 3)
                         //$gx[$valuega]=$gaa[1];no sirve, al poner nombre a la clave se vuelve multidimensional
                         //$gx[][$valuega]=$gaa[1];
                         $$vvalores[]=$gaa[1];//realmente esta guardando $Tallas[]=[s,m,l] $Colores[]=[rojo,verde,azul]...pero ahora $Tallas[]=[1,2,3] $Colores[]=[4,5,6].
                         //$gx[$valuega][]=$gaa[1];
                     }
                 }
                 //al salir del bucle si $i=0 significa que el grupo atributo no tiene nada seleccionado
                 //ejemplo si solo escojo (tallas = s,m,l) (colores rojo,azul) al entrar a volumen sin seleccion i=0
                 //$i acumula 3 luego 2
                 if($i!=0){//validamos para que no cuente grupos de atributos no escogidos
                     $pd=$pd*$i;//$p seria 6

                 }
             }



             foreach ($ggrupoatributosescogidosfinal as $escogidos) {
                 // dd($$escogidos);
                 $ggaaa[]=$escogidos;//$gaaa['Tallas','Colores']
             }
             //dd($gaaa[0]);

             $fa = count($ggaaa);

             if($fa == 1){
                 $nnoma= $ggaaa[0];//$gaaa[0]=Tallas, $noma = Tallas y $$noma =$Tallas
                 $res2 = $$nnoma;//res devuelve tantos valores como p osea si p es 4, entonces res tiene 4 valores, y cada valor es un array que tiene 2 datos pero en este caso solo tiene 1 dato
                 //dd($res);
                 //dd($res[0]);
             }



             if($fa == 2){
                 $nnoma= $ggaaa[0];//$gaaa[0]=Tallas
                 $nnomb= $ggaaa[1];//$gaaa[1]=Colores
                 //dd($$noma);
                 $ccollection=collect($$nnomb);//$$noma =$Tallas pero $Tallas=[1,2,3]   ver linea 82
                 $mmatrix=$ccollection->crossJoin($$nnoma);//$$nomb =$Colores pero $Colores=[4,5,6]   ver linea 82
                 $res2 = $mmatrix->all();//res devuelve tantos valores como p osea si p es 4, entonces res tiene 4 valores, y cada valor es un array que tiene 2 datos ejemplo (s,rojo) o (1,8)
                 //dd($res);
                 //dd($res[0]);
             }

             if($fa == 3){
                 $nnoma= $ggaaa[0];
                 $nnomb= $ggaaa[1];
                 $nnomc= $ggaaa[2];

                 $ccollection=collect($$nnoma);
                 $mmatrix=$ccollection->crossJoin($$nnomb, $$nnomc);
                 $res2 = $mmatrix->all();

             }

             if($fa == 4){
                 $nnoma= $ggaaa[0];
                 $nnomb= $ggaaa[1];
                 $nnomc= $ggaaa[2];
                 $nnomd= $ggaaa[3];

                 $ccollection=collect($$nnoma);
                 $mmatrix=$ccollection->crossJoin($$nnomb, $$nnomc, $$nnomd);
                 $res2 = $mmatrix->all();
             }


             //dd($res2);
             //$ref = array_diff($res, $res2);
             //resf = res -res2
             //$resf = $res->diffAssoc($res2->collect());
            /// $colletflor = collect($res);
             //$resf = $colletflor->diff($res2);
            /// $resf = $colletflor->diff($res2);

             //dd($resf);


             $collres2 = collect($res2);

             foreach ($res as $key => $value) {
                 if ($collres2->contains($value)) {
                     unset($res[$key]);
                 }
             }

            // $resf = $res;
             //dd($res);
             foreach ($res as $value) {
                 $resf[]=$value;
             }

             //dd($resf);




             $pf = $p-$pd;

             //generamos el producto, p y res tiene la misma cantidad, si p=4  restiene 4 registros y cada registro 2 datos
             for ($i=0; $i < $pf; $i++) {
                 $productatribute = Productatribute::create([
                     'codigo' => $random = Str::random(10),
                     'price'=>100,
                     'state' => 1,
                     'productfamilie_id' => $this->product->id
                 ]);

                 $productatribute->atributes()->attach($resf[$i]);
                 //$productatribute->atributes()->sync($res[$i]);
             }



            // dd(($this->createForm['atributes']));

            /* $this->product->update([
             'flag' => 1
            ]); */
            //no cambia el flag por eso use save

            $this->product->flag = 1;
            $this->product->save();

            return redirect()->route('productcompuesto.list', $this->product->id);





        }//fin del if




    }










}
