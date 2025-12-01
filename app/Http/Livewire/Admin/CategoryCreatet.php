<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryCreatet extends Component
{

    use WithFileUploads;

    use WithPagination;
    public $name;
    public $categories;
    public $newCategoryName;

    public $parentCategories;
    public $maxDepth;

    public $selectedCategory;

    public $lastSelectedParentCategory;
    public $selectedParentCategory1; // Agrega esta propiedad
    public $breadcrumbs;
    public $shortdescription, $longdescription, $image, $identificador, $order;
    public $company;

    protected $listeners = ['categorySelected', 'updateSelectedParentCategory'];


    /* protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,NULL',
        'image'=> 'nullable',
    ]; */

    protected $rules = [
        'name' => 'required|string|max:255',
        'image'=> 'nullable',
    ];


    public function mount()
    {

        $this->company = auth()->user()->employee->company;

        // Obtener las categorías raíz
        $this->categories = Category::whereNull('parent_id')->where('company_id', $this->company->id)->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        });

        $this->lastSelectedParentCategory = null;
        //$this->lastSelectedParentCategory = null;
        $this->selectedParentCategory1 = null;

        //$this->identificador = rand();
    }

    public function updatedSelectedParentCategory1($value)
    {
        $this->lastSelectedParentCategory = $value;
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


    public function save()
    {
        // Validación del nombre de la categoría
        /* $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,NULL',
        ]); */
        //$categoriespadres = Category::whereNull('parent_id')->get();

        if($this->image){
            $rules = $this->rules;
            $rules['image'] = 'require|image|mimes:jpeg,png|max:2048';
            $this->validate();
            //$image1 = $this->image1->store('products', 'public');
            //$urlimage1 = Storage::url($image1);
            $urlimage = Storage::disk('s3')->put('fe/'.$this->company->razonsocial.'/categories', $this->image , 'public');
        }
        else {
            $this->validate();
            //$urlimage1 = '/storage/products/default.jpg';
            $urlimage = 'fe/default/categories/categorydefault.jpg';

        }


        if ($this->lastSelectedParentCategory) {
            $categoryreference = Category::find($this->lastSelectedParentCategory);
            $depth = $categoryreference->depth + 1;
            $path = $categoryreference->path . "/" . $this->name;
        } else {
            $depth = 0;
            $path = $this->name;
        }
        // Crear la nueva categoría
        Category::create([
            'name' => $this->name,
            'parent_id' => $this->lastSelectedParentCategory ?? null, // Asignar la categoría padre si se seleccionó
            'shortdescription' =>  $this->shortdescription,
            'longdescription' =>  $this->longdescription,
            'order' =>  $this->order,
            'depth' => $depth,
            'path' => $path,
            'company_id' => $this->company->id,
            'image'=> $urlimage
        ]);
        // Limpiar los campos después de la creación
        //$this->name = '';
        //$this->selectedCategory = null;
        $this->emit('alert', 'La Categoria se creo correctamente');
        //$this->render();
        //return view('livewire.admin.category-listd');
        return redirect()->route('category.listd');

        // Actualizar la lista de categorías
        /*  $this->categories = Category::whereNull('parent_id')->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        }); */
    }


    public function render()
    {
        if ($this->lastSelectedParentCategory) {
            $categoryreference = Category::find($this->lastSelectedParentCategory);
            $this->breadcrumbs = $categoryreference->path;
        } else {
            $this->breadcrumbs = '/';
        }

        //dd($categoryreference);


        return view('livewire.admin.category-createt');
    }
}
