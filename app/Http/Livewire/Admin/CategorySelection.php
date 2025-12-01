<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategorySelection extends Component
{

    public $selectedCategories = [];
    public $rootCategories;

    public function mount()
    {
        // Inicializar $selectedCategories con un array vacío
        $this->selectedCategories = [];

        // Obtener las categorías raíz para el primer select
        $this->rootCategories = Category::whereNull('parent_id')->get();
    }

    public function loadSubcategories($parentId)
    {
        // Cargar subcategorías de la categoría seleccionada
        $this->selectedCategories[] = $parentId;
    }

    public function render()
    {
        // No es necesario renderizar la vista aquí
        return view('livewire.admin.category-selection');
    }
}
