<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CategoryList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $search, $image, $category, $state, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->identificador = rand();
        //$this->category = new Category();
        $this->image = "";
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadCategories()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $this->authorize('create', new Category);
        $companyId = auth()->user()->employee->company->id;
        //dd($companyId);

        if ($this->readyToLoad) {

            $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->where('company_id', $companyId)
            ->paginate(10);
        } else {
            $categories = [];
        }
        return view('livewire.admin.category-list', compact('categories'));
    }


    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }



    public function activar($categoryy)
    {

        Category::find($categoryy)
        ->update(['state' => 1]);
    }

    public function desactivar($categoryy)
    {

        Category::find($categoryy)
        ->update(['state' => 0]);
    }

}
