<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategorySelector extends Component
{
    public $categories1;
    public $categories2;
    public $categories3;
    public $categories4;
    public $categories5;
    public $categories6;
    public $selectedCategory1 = null;
    public $selectedCategory2 = null;
    public $selectedCategory3 = null;
    public $selectedCategory4 = null;
    public $selectedCategory5 = null;
    public $selectedCategory6 = null;

    public function mount()
    {
        $this->categories1 = Category::whereNull('parent_id')->get();
    }

    public function updatedSelectedCategory1($categoryId)
    {
        $this->selectedCategory2 = null; // Reiniciar la selección del segundo nivel
        $this->selectedCategory3 = null; // Reiniciar la selección del tercer nivel
        $this->selectedCategory4 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory5 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory6 = null; // Reiniciar la selección del cuarto nivel

        $this->categories2 = Category::where('parent_id', $categoryId)->get();
        //dd($this->categories2);

    }

    public function updatedSelectedCategory2($categoryId)
    {
        $this->selectedCategory3 = null; // Reiniciar la selección del tercer nivel
        $this->selectedCategory4 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory5 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory6 = null; // Reiniciar la selección del cuarto nivel

        $this->categories3 = Category::where('parent_id', $categoryId)->get();
    }

    public function updatedSelectedCategory3($categoryId)
    {
        $this->selectedCategory4 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory5 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory6 = null; // Reiniciar la selección del cuarto nivel

        $this->categories4 = Category::where('parent_id', $categoryId)->get();
    }


    public function updatedSelectedCategory4($categoryId)
    {
        $this->selectedCategory5 = null; // Reiniciar la selección del cuarto nivel
        $this->selectedCategory6 = null; // Reiniciar la selección del cuarto nivel

        $this->categories5 = Category::where('parent_id', $categoryId)->get();
    }

    public function updatedSelectedCategory5($categoryId)
    {
        $this->selectedCategory6 = null; // Reiniciar la selección del cuarto nivel

        $this->categories6 = Category::where('parent_id', $categoryId)->get();

    }

    public function render()
    {
        return view('livewire.admin.category-selector');
    }

  /*   public function updatedSelectedCategory6($categoryId)
    {
        $this->emit('categorySelected', $categoryId);
    } */


    /*     public $categories;
    public $selectedCategory = null;


    public function mount()
    {
        $this->categories = Category::whereNull('parent_id')->get();
    }

    public function updatedSelectedCategory($categoryId)
    {

        $this->categories = Category::where('parent_id', $categoryId)->get();

    }

    public function render()
    {

        return view('livewire.admin.category-selector');
    }
 */
}
