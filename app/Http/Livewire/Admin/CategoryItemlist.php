<?php

namespace App\Http\Livewire\Admin;
use App\Models\Category;
use Livewire\Component;

class CategoryItemlist extends Component
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
        return view('livewire.admin.category-itemlist', [
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

    public function editCategory($categoryId)
    {
        return view('livewire.admin.category-editd');

    }


    public function delete(Category $category)
    {
        dd($category);
        $category->delete();
    }


   /*  public function activar(Category $category)
    {

        $this->authorize('update', $this->category);

        $this->category = $category;

        $this->category->update([
            'state' => 1
        ]);
    }

    public function desactivar(Category $category)
    {

        $this->authorize('update', $this->category);

        $this->category = $category;

        $this->category->update([
            'state' => 0
        ]);
    } */



}
