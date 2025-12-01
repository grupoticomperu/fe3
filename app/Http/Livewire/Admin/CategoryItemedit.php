<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategoryItemedit extends Component
{

    public $category;
    public $isOpen = false;
    public $selectedParentCategory;
    public $editingCategoryName = false;
    public $editingCategoryId = null;
    public $deshabilitar;


    public function mount(Category $category, $isOpen = false, $selectedParentCategory = null, $deshabilitar)
    {
        $this->deshabilitar = $deshabilitar;
        //dd($this->deshabilitar);
        $this->category = $category;
        $this->isOpen = $isOpen;
        $this->selectedParentCategory = $selectedParentCategory;
    }


    public function updatedSelectedParentCategory($value)
    {
        $this->emit('categorySelected', $value);
        $this->emit('updateSelectedParentCategory', $value);
        //dd($value);
    }


    public function toggle($categoryId)
    {
        if ($this->editingCategoryId === $categoryId) {
            $this->isOpen = !$this->isOpen;
        }
    }



    public function render()
    {
        return view('livewire.admin.category-itemedit', [
            'depth' => $this->calculateDepth($this->category),
            'deshabilitar' => $this->deshabilitar
        ]);
    }


    protected function calculateDepth($category, $depth = 0)
    {
        if (!$category->parent) {
            return $depth;
        } else {
            return $this->calculateDepth($category->parent, $depth + 1);
        }
    }


    public function hasChildren()
    {
        return $this->category->children->isNotEmpty();
    }


}
