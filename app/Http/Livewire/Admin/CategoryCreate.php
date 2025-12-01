<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryCreate extends Component
{

    use AuthorizesRequests;
    use WithFileUploads;
    public $open = false;
    public $identificador, $name, $slug, $state, $shortdescription, $longdescription, $order, $image, $title, $description, $keywords;

    public function mount()
    {
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.admin.category-create');
    }

    public function nuevo()
    {
        $this->identificador = rand();
        $this->open = true;
        $this->reset(['image']);
    }

    protected $rules = [
        'name'=> 'required|unique:categories',
        'state'=>'nullable',
        'shortdescription'=>'nullable',
        'longdescription'=>'nullable',
        'order'=>'nullable',
        'image'=>'required|image|max:2048',
        'title'=>'nullable',
        'description'=>'nullable',
        'keywords'=>'nullable'
    ];


    public function save(){
        $this->authorize('create', new Category);
        $this->validate();

        $image = $this->image->store('categories', 'public');
        $urlimage = Storage::url($image);
        //dd($this->state);

        $statee = ($this->state) ? 1 : 0 ;


        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'state' => $statee,
            'shortdescription'=> $this->shortdescription,
            'longdescription'=> $this->shortdescription,
            'order'=> $this->order,
            'image' => $urlimage,
            'title'=> $this->title,
            'description'=> $this->description,
            'keywords'=> $this->keywords,
        ]);

        $this->reset(['open','name','image', 'name', 'slug', 'state', 'shortdescription', 'longdescription', 'order', 'image', 'title', 'description', 'keywords']);

        $this->emitTo('admin.category-list','render');

        $this->emit('alert','La categoria se creo correctamente');
    }


}
