<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryCreated extends Component
{

    public $selectedCategory=null;
    public $name;

    public $categories1;
    public $categories2;
    public $categories3;
    public $categories4;
    public $categories5;
    public $categories6;
    public $categories7;
    public $categories8;
    public $categories9;
    public $categories10;
    public $categories11;
    public $selectedCategory1 = null;
    public $selectedCategory2 = null;
    public $selectedCategory3 = null;
    public $selectedCategory4 = null;
    public $selectedCategory5 = null;
    public $selectedCategory6 = null;
    public $selectedCategory7 = null;
    public $selectedCategory8 = null;
    public $selectedCategory9 = null;
    public $selectedCategory10 = null;
    public $selectedCategory11 = null;

    protected $listeners = ['categorySelected'];

    public function mount()
    {
        $this->categories1 = Category::whereNull('parent_id')->get();
    }

    public function updatedSelectedCategory1($categoryId)
    {
        $this->selectedCategory2 = null;
        $this->selectedCategory3 = null;
        $this->selectedCategory4 = null;
        $this->selectedCategory5 = null;
        $this->selectedCategory6 = null;
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;
        $this->categories2 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;
        //dd($this->categories2);

    }

    public function updatedSelectedCategory2($categoryId)
    {
        $this->selectedCategory3 = null;
        $this->selectedCategory4 = null;
        $this->selectedCategory5 = null;
        $this->selectedCategory6 = null;
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;
        $this->categories3 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }

    public function updatedSelectedCategory3($categoryId)
    {
        $this->selectedCategory4 = null;
        $this->selectedCategory5 = null;
        $this->selectedCategory6 = null;
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;
        $this->categories4 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;
    }


    public function updatedSelectedCategory4($categoryId)
    {
        $this->selectedCategory5 = null;
        $this->selectedCategory6 = null;
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;
        $this->categories5 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;
    }

    public function updatedSelectedCategory5($categoryId)
    {
        $this->selectedCategory6 = null;
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;
        $this->categories6 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }


    public function updatedSelectedCategory6($categoryId)
    {
        $this->selectedCategory7 = null;
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;

        $this->categories7 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }

    public function updatedSelectedCategory7($categoryId)
    {
        $this->selectedCategory8 = null;
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;

        $this->categories8 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }


    public function updatedSelectedCategory8($categoryId)
    {
        $this->selectedCategory9 = null;
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;

        $this->categories9 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }

    public function updatedSelectedCategory9($categoryId)
    {
        $this->selectedCategory10 = null;
        $this->selectedCategory11 = null;

        $this->categories10 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;
    }

    public function updatedSelectedCategory10($categoryId)
    {
        $this->selectedCategory11 = null;

        $this->categories11 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;
    }

    public function updatedSelectedCategory11($categoryId)
    {
        //$this->selectedCategory7 = null;

        //$this->categories7 = Category::where('parent_id', $categoryId)->get();
        $this->selectedCategory = $categoryId;

    }
    //hasta 10 niveles el 11avo ya no tiene subnivel

    public function render()
    {
        // Almacenar el valor seleccionado en la sesión

        // Obtener las categorías raíz para el primer select

        return view('livewire.admin.category-created');
    }


    /* public function categorySelected($categoryId)
    {
        $this->selectedCategory = $categoryId;
    } */

    public function save()
    {
        if($this->selectedCategory){
            $categoryreference = Category::find($this->selectedCategory);
            $depth = $categoryreference->depth + 1;
            $path = $categoryreference->path . "/" . $this->name;
            //dd($path);
        }else{
            $depth = 0;
            $path = $this->name;
        }


        Category::create([
            'name' => $this->name,
            'parent_id' => $this->selectedCategory,
            'depth' => $depth,
            'path' => $path,
            'company_id' => auth()->user()->employee->company->id, //encontramos la company actual osea la compania del usuario logueado,
        ]);
    }
}
