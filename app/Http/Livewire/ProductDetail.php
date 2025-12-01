<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Productatribute;
use App\Models\Productfamilie;

class ProductDetail extends Component
{
    public $productfamilie;
    public $selectedAttributes = [];
    public $selectedTallas, $selectedColores;
    public $atributes;

    public function mount(Productfamilie $product)
    {
        /* $this->productfamilie = $product;
        foreach($this->productfamilie->productatributes as $productatribute){
            foreach ($productatribute->local_productatributes as $lpa) {
                if($lpa->local_id==1 && $lpa->stock){
                    $stock[$lpa->productatribute_id]= $lpa->stock;//muestra el stock de los productos en el local 1
                    //juntamos los group atributes
                    $pa=Productatribute::find($lpa->productatribute_id);
                    dd($pa);
                    foreach ($pa->atribute_productatributes as $atribute_productatribute) {
                        $ga[$atribute_productatribute->atribute->groupatribute->id]=$atribute_productatribute->atribute->groupatribute->name;
                        $atributes[$atribute_productatribute->atribute->groupatribute->name][]=$atribute_productatribute->atribute->name;
                    }
                    //los atributos o valores del los griupatributes

                }


            }
        } */




        /* $this->productfamilie = $product;
        $uniqueAtributes = [];
        foreach ($this->productfamilie->productatributes as $productatribute) {
            foreach ($productatribute->local_productatributes as $lpa) {
                if ($lpa->local_id == 1 && $lpa->stock) {
                    $stock[$lpa->productatribute_id] = $lpa->stock;

                    $pa = Productatribute::find($lpa->productatribute_id);

                    foreach ($pa->atribute_productatributes as $atribute_productatribute) {
                        $groupAtributeId = $atribute_productatribute->atribute->groupatribute->id;
                        $groupAtributeName = $atribute_productatribute->atribute->groupatribute->name;
                        $atributeId = $atribute_productatribute->atribute->id;
                        $atributeName = $atribute_productatribute->atribute->name;

                        // Agregar valores únicos a los arreglos
                        if (!in_array($groupAtributeName, $uniqueAtributes)) {
                            $uniqueAtributes[] = $groupAtributeName;
                        }

                        if (!isset($atributes[$groupAtributeName])) {
                            $atributes[$groupAtributeName] = [];
                        }

                        if (!in_array($atributeName, $atributes[$groupAtributeName])) {
                            $atributes[$groupAtributeName][] = [$atributeId, $atributeName];
                        }
                    }
                }
            }
        } */



        $this->productfamilie = $product;
        $uniqueAtributes = []; // Para mantener un seguimiento de los valores únicos

        foreach ($this->productfamilie->productatributes as $productatribute) {
            foreach ($productatribute->local_productatributes as $lpa) {
                if ($lpa->local_id == 1 && $lpa->stock) {
                    $stock[$lpa->productatribute_id] = $lpa->stock;

                    $pa = Productatribute::find($lpa->productatribute_id);

                    foreach ($pa->atribute_productatributes as $atribute_productatribute) {
                        $groupAtributeId = $atribute_productatribute->atribute->groupatribute->id;
                        $groupAtributeName = $atribute_productatribute->atribute->groupatribute->name;
                        $atributeId = $atribute_productatribute->atribute->id;
                        $atributeName = $atribute_productatribute->atribute->name;

                        // Agregar valores únicos a los arreglos
                        if (!in_array($groupAtributeName, $uniqueAtributes)) {
                            $uniqueAtributes[] = $groupAtributeName;
                        }

                        if (!isset($this->atributes[$groupAtributeName])) {
                            $this->atributes[$groupAtributeName] = [];
                        }

                        $alreadyExists = false;
                        foreach ($this->atributes[$groupAtributeName] as $existingAtribute) {
                            if ($existingAtribute[0] === $atributeId) {
                                $alreadyExists = true;
                                break;
                            }
                        }

                        if (!$alreadyExists) {
                            $this->atributes[$groupAtributeName][] = [$atributeId, $atributeName];
                        }
                    }
                }
            }
        }






         //dd($stock);
         //dd($ga);
         //dd($uniqueAtributes);
         //dd($this->atributes);
        //$this->productfamilie->load('productatributes.atributes.groupatribute');
        //dd($this->productfamilie->productatributes);
        //$this->subcategoryslug = $subcategory;

        // $subcategoria = Subcategory::with('productfamilies.productatributes.locales')->find($this->subcategoryId);
    }



    /*     public function getGroupedAttributesProperty()
    {
        return $this->productfamilie->productatributes->groupBy(function ($item) {
            return $item->atributes->first()->groupatribute->name;
        });
    } */


    public function getGroupedAttributesProperty()
    {
        $grupo = [];

        foreach ($this->productfamilie->productatributes as $productatribute) {
            foreach ($productatribute->local_productatributes as $local_productatribute) {

                if ($local_productatribute->local_id === 1 && $local_productatribute->stock > 0) {
                    foreach ($productatribute->atribute_productatributes as $atribute_productatribute) {

                        $groupName = $atribute_productatribute->atribute->groupatribute->name;

                        if (!isset($grupo[$groupName])) {
                            $grupo[$groupName] = [];
                        }
                        $productAtributeId = $productatribute->id;
                        $atributeName = $atribute_productatribute->atribute->name;
                        $atributeId = $atribute_productatribute->atribute->id;

                        if (!in_array($atributeName, $grupo[$groupName])) {
                            $grupo[$groupName][$atributeId] = $atributeName;
                        }
                    }
                }
            }
        }

        return $grupo;
    }



    /*     public function getGroupedAttributesProperty()
    {
        $grupo = [];

        foreach ($this->productfamilie->productatributes as $productatribute) {
            foreach ($productatribute->local_productatributes as $local_productatribute) {


                if ($local_productatribute->local_id === 1 && $local_productatribute->stock > 0) {
                    foreach ($productatribute->atribute_productatributes as $atribute_productatribute) {
                        $groupName = $atribute_productatribute->atribute->groupatribute->name;

                        if (!isset($grupo[$groupName])) {
                            $grupo[$groupName] = [];
                        }

                        $productAtributeId = $productatribute->id;
                        $atributeId = $atribute_productatribute->atribute->id;
                        $atributeName = $atribute_productatribute->atribute->name;


                        $alreadyAdded = false;
                        foreach ($grupo[$groupName] as $atribute) {
                            if ($atribute['atributeId'] === $atributeId) {
                                $alreadyAdded = true;
                                break;
                            }
                        }

                        // Si el atributo no ha sido agregado, lo agregamos al grupo
                        if (!$alreadyAdded) {
                            $grupo[$groupName][] = [
                                'productAtributeId' => $productAtributeId,
                                'atributeId' => $atributeId,
                                'atributeName' => $atributeName,
                            ];
                        }
                    }
                }
            }
        }

        return $grupo;
    } */





    public function updatingSelectedAttributes($value, $key)
    {
        // Acceder a los valores seleccionados para el grupo "talla"
        $this->selectedTallas = $this->selectedAttributes['Tallas'];

        // Acceder a los valores seleccionados para el grupo "color"
        $this->selectedColores = $this->selectedAttributes['Colores'];

       // dd($this->selectedTallas, $this->selectedColores);
    }






    public function render()
    {
        $categories = Category::where('state', 1)->get();
        $groupedAttributes = $this->groupedAttributes;
        //dd($groupedAttributes);

        //dd($this->productfamilie->productatributes->atributes);
        /*         $grupo=[];
        foreach ($this->productfamilie->productatributes as $productatribute) {
            $atributes = $productatribute->atribute_productatributes;

            foreach ($productatribute->atribute_productatributes as $atribute_productatribute){
              $groupName = $atribute_productatribute->atribute->groupatribute->name;

              if (!isset($grupo[$groupName])) {
                  $grupo[$groupName] = [];
              }

              $atributeName = $atribute_productatribute->atribute->name;

              if (!in_array($atributeName, $grupo[$groupName])) {
                  $grupo[$groupName][] = $atributeName;
              }


            }

        } */

        //dd($this->selectedAttributes);

        return view('livewire.product-detail', compact('categories', 'groupedAttributes'))->layout('layouts.appweb');

        //return view('livewire.product-detail', compact('categories'))->layout('layouts.appweb');
    }
}
