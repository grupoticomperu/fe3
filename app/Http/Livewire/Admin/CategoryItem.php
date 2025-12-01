<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
//estamos usando CategoryItem crear uno nuevo
class CategoryItem extends Component
{

    public $category;
    public $isOpen = false;
    public $selectedParentCategory;
    public $editingCategoryName = false;
    public $editingCategoryId = null;


    public function mount(Category $category, $isOpen = false, $selectedParentCategory = null)
    {
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

        return view('livewire.admin.category-item', [
            'depth' => $this->calculateDepth($this->category),
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

  /*   public function editCategory($categoryId)
    {
        return view('livewire.admin.category-editd');

    }

    public function confirmDeleteCategory($categoryId)
    {

        $this->emit('confirmDeleteCategory', $categoryId);
    } */
}
