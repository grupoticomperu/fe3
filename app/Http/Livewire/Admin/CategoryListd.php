<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryListd extends Component
{
    use WithPagination;

    public $categories;
    public $companyId;
    //public $category;

    //protected $listeners = ['confirmDeleteCategory'];

    public function mount()
    {
        $this->companyId = auth()->user()->employee->company->id;
        // Obtener las categorías raíz y calcular su profundidad, whereNull cuando sea null
        $this->categories = Category::whereNull('parent_id')->where('company_id', $this->companyId)->get();
        /* $this->categories = Category::whereNull('parent_id')->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        }); */
        // dd($this->categories );
    }

    /*   protected function calculateDepth($category, $depth = 0)
    {

        if (!$category->parent) {
            return $depth;
        } else {
            return $this->calculateDepth($category->parent, $depth + 1);
        }
    } */


   /*  public function activar(Category $category)
    {
       // dd($category);

        //$this->authorize('update', $this->category);

        $this->category = $category;

        $this->category->update([
            'state' => 1
        ]);
    }

    public function desactivar(Category $category)
    {

        //$this->authorize('update', $this->category);

        $this->category = $category;

        $this->category->update([
            'state' => 0
        ]);
    } */


     public function delete(Category $category)
    {
        //dd($category);
        $category->delete();
    }

    public function render()
    {

            /*  $categoriesPaginated = $this->categories->paginate(5);

        return view('livewire.admin.category-listd', ['categories' => $categoriesPaginated]) */;
        // Obtener las categorías raíz y paginar los resultados
        //$categories = Category::whereNull('parent_id')->paginate(5);

        return view('livewire.admin.category-listd');
    }





}
