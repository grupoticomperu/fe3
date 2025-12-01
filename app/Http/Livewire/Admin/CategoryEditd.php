<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CategoryEditd extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $breadcrumbs;
    public $selectedParentCategory1;
    public $categories;
    public $lastSelectedParentCategory;
    public $identificador;
    public $image, $imageback;
    public $name, $nameback;
    public $selectedCategoryId;
    public $openCategories = [];
    public $category, $company;
    public $shortdescription, $longdescription, $order, $parent_id, $depth, $path, $pathback;
    public $deshabilitar;


    protected $listeners = ['categorySelected', 'updateSelectedParentCategory'];


    protected $rules = [
        'name'=> 'required',
    ];



    public function mount($categoryId)
    {
        $this->company = auth()->user()->employee->company;
        $this->deshabilitar=0;
        $this->categoryId = $categoryId;
        $this->lastSelectedParentCategory = $categoryId; //es id de la categoria esgogida
        //dd($this->lastSelectedParentCategory);
        $this->selectedParentCategory1 = $categoryId;

        $this->selectedCategoryId = $categoryId;
        //$this->category = new Category();
        $this->category = Category::find($this->categoryId); //actualizaremos esta categoria
        $this->shortdescription = $this->category->shortdescription;
        $this->longdescription = $this->category->longdescription;
        $this->order = $this->category->order;
        $this->name = $this->category->name;
        $this->image = null;
        $this->imageback = $this->category->image;
        $this->nameback = $this->category->name;
        $this->depth = $this->category->depth;
        $this->pathback = $this->category->path;
        //dd($this->path);
        $this->parent_id = $this->category->parent_id; //$this->parent_id  guarda el parent id de la categoria
        //dd($this->parent_id);
        /*while ($category) {
            $this->openCategories[] = $category->id;
            $category = $category->parent;
        } */
        // Obtener las categorías raíz
        $this->categories = Category::whereNull('parent_id')->where('company_id', $this->company->razonsocial )->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        });


        $this->identificador = rand();
    }


    public function categorySelected($value)
    {
        $this->lastSelectedParentCategory = $value;
    }

    public function updateSelectedParentCategory($value)
    {
        // Actualizar la variable lastSelectedParentCategory cuando se seleccione un nuevo radio button
        $this->selectedParentCategory1 = $value;
        //$this->lastSelectedParentCategory = $value;

    }





    protected function calculateDepth($category, $depth = 0)
    {
        if (!$category->parent) {
            return $depth;
        } else {
            return $this->calculateDepth($category->parent, $depth + 1);
        }
    }

    public function updatedSelectedParentCategory1($value)
    {
        //dd( $value );
        $this->lastSelectedParentCategory = $value;
        //dd($this->lastSelectedParentCategory);
    }



    public function save()
    {

        //dd($this->category);

        // Validación del nombre de la categoría
        /* $this->validate([
            //'name' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,NULL',
        ]); */

        /* $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $this->categoryId . ',id,parent_id,NULL',
        ]); */

        //$category = Category::findOrFail($this->categoryId);
        //$this->category = Category::find($categoryId);

        $this->category->name = $this->name;
        $this->category->shortdescription = $this->shortdescription;
        $this->category->longdescription = $this->longdescription;
        $this->category->order = $this->order;
        //ponemos esto si cambio el parent_id
        //$this->category->parent_id = $this->lastSelectedParentCategory ?? null;
        $this->category->parent_id = $this->selectedParentCategory1 ?? null;

        // Verificar si la categoría principal está seleccionada y asignar el parent_id en consecuencia
        /* if ($this->selectedParentCategory1 !== null) {
            $this->category->parent_id = $this->selectedParentCategory1;
        } else {
            $this->category->parent_id = null;
        } */


        if($this->image){
            // dd($this->image);
             $rules['image'] ='required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
             $this->validate($rules);
             //Storage::delete([$this->product->image]);
             //$this->product->image = Storage::url($this->image->store('products', 'public'));
             //$image1 = $this->product->image;
            // Storage::disk('s3')->delete([$this->product->image]);
            $this->category->image = Storage::disk('s3')->put('fe/'.$this->company->id.'/categories', $this->image , 'public');
         }else{
            // dd($this->image);
            $this->category->image = $this->imageback;//no hay cambios en la imagen
           // $this->validate();
         }


        //dd($this->category->parent_id);

        if ($this->lastSelectedParentCategory != 9999) {
            //tenemos que comprobar si cambio de parent_id, entonces le asignamos el parent_id escogido

            if ($this->categoryId == $this->lastSelectedParentCategory) {
                //dd($this->lastSelectedParentCategory);
                //dd("estoy aqui");
                $this->category->parent_id = $this->parent_id;
                //$this->category->path = $this->name;
                $this->category->depth = $this->category->depth;//asignando a la categoria a modificar la profundidad actual
                //dd($this->category->depth);
                $this->category->path = $this->path;//asignando a la categoria a modificar la ruta actual
                $depthcategoria = $this->depth; //usare la variable que tiene la profundidad actual
                $pathcategoria = $this->pathback;//usare la variable que tiene la ruta actual
                //dd($pathcategoria);
                if($this->name != $this->nameback)
                {
                    //$pathcategoriacortada = explode("/", $pathcategoria)[0];
                    $partes = explode("/", $pathcategoria);
                    $pathcategoriacortada = implode("/", array_slice($partes, 0, -1));
                    //dd($pathcategoriacortada);
                    if($pathcategoriacortada)
                    {
                        $pathcategoria = $pathcategoriacortada. "/". $this->name;
                    }
                    else
                    {
                        $pathcategoria = $this->name;
                    }

                    //dd($pathcategoria);

                    $this->category->path = $pathcategoria;
                    //dd($pathcategoria);
                    //$pathcategoria = 'Damas/calzonetas';
                    if($this->category->children){
                        foreach($this->category->children as $children){
                            $categoriahija = Category::find($children->id);
                            //dd("estoy aqui");
                            //dd($categoriahija);
                            $categoriahija->depth =  $depthcategoria +1;
                            $categoriahija->path =  $pathcategoria . "/" . $children->name;
                            $categoriahija->save();

                            $this->guardarpaths($categoriahija, $categoriahija->depth, $categoriahija->path);
                        }
                    }elseif($this->depth>0){
                        //si no tiene hijas, esta al ultimo
                    }
                }

            } else {
                $this->category->parent_id = $this->lastSelectedParentCategory ?? null;
                //$categoryreference es la actual categoria escogida, osea a donde se ira
                $categoryreference = Category::find($this->lastSelectedParentCategory);
                $this->category->depth = $categoryreference->depth + 1;//asignando a la categoria a modificar la profundidad actual
                $this->category->path = $categoryreference->path . "/" . $this->name;//asignando a la categoria a modificar la ruta actual
                $depthcategoria = $categoryreference->depth + 1; //usare la variable que tiene la profundidad actual
                $pathcategoria = $categoryreference->path . "/" . $this->name;//usare la variable que tiene la ruta actual
                //ahora tenemos que buscar las subcategorias y cambiar sus path
                if($this->category->children){
                    //dd($this->category->children);
                    foreach($this->category->children as $children){
                        $categoriahija = Category::find($children->id);
                        //dd($categoriahija);
                        $categoriahija->depth =  $depthcategoria +1;
                        $categoriahija->path =  $pathcategoria . "/" . $children->name;
                        $categoriahija->save();

                        $this->guardarpaths($categoriahija, $categoriahija->depth, $categoriahija->path);
                    }
                }
            }
        } else {
            $this->category->depth = 0;
            $this->category->path = $this->name;
            $this->category->parent_id = null;
            if($this->category->children){
                //dd($this->category->children);
                foreach($this->category->children as $children){
                    $categoriahija = Category::find($children->id);
                    //dd($categoriahija);
                    $categoriahija->depth = 1;
                    $categoriahija->path =  $this->name . "/" . $children->name;//name tiene el valor raiz
                    $categoriahija->save();

                    $this->guardarpaths($categoriahija, $categoriahija->depth, $categoriahija->path);
                }
            }

        }

        $this->category->save();

        $this->emit('alert', 'La Categoria se Modifico correctamente');
        return redirect()->route('category.listd');

        // Crear la nueva categoría
        /*  $this->category->save([
            'name' => $this->name,
            'parent_id' => $this->lastSelectedParentCategory ?? null, // Asignar la categoría padre si se seleccionó
            'depth' => $depth,
            'path' => $path,
            'shortdescription' => $this->shortdescription,
            'company_id' => auth()->user()->employee->company->id,
        ]); */

        // Limpiar los campos después de la creación
        //$this->name = '';
        //$this->selectedCategory = null;

        // Actualizar la lista de categorías
        /*  $this->categories = Category::whereNull('parent_id')->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        }); */
    }

    public function guardarpaths(Category $category, $depthcategoria, $pathcategoria ){
        foreach($category->children as $children){
            $categoriahija = Category::find($children->id);
            //dd($categoriahija);
            $categoriahija->depth =  $depthcategoria +1;
            $categoriahija->path =  $pathcategoria . "/" . $children->name;
            $categoriahija->save();

            $this->guardarpaths($categoriahija, $categoriahija->depth, $categoriahija->path);
        }



    }



    public function render()
    {

        if ($this->lastSelectedParentCategory != 9999) {
            $categoryreference = Category::find($this->lastSelectedParentCategory);
            $this->breadcrumbs = $categoryreference->path;//path es el campo guardado en la tabla
        } else {
            $this->breadcrumbs = '/';
        }



        // Obtener la categoría para editar
        //$category = Category::findOrFail($this->categoryId);
        //$this->breadcrumbs = $category->path;
        //return view('livewire.admin.category-editd', compact('category'));
        return view('livewire.admin.category-editd', [
            'openCategories' => $this->openCategories,
        ]);
        //return view('livewire.admin.category-editd');
    }
}
