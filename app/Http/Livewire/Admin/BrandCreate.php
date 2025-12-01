<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Configuration;

class BrandCreate extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $open = false;
    public $companyId, $razonsocial;

    public $name, $state, $image, $identificador, $title, $description, $keywords, $order;
    public $company;

    public function mount()
    {
        $this->identificador = rand();
        $this->companyId = auth()->user()->employee->company->id;
        $this->razonsocial = auth()->user()->employee->company->razonsocial;
    }

    public function nuevo()
    {
        $this->identificador = rand();
        $this->open = true;
        $this->reset(['image']);
    }


    protected $rules = [
        'name' => '',
        'image' => '',
        //esta validaciones no es necesario al momento de crear nueva marca
        /* 'title'=>'',
        'description'=>'',
        'keywords'=>'', */

    ];



    public function rules()
    {
        $rules = $this->rules;

        // Agrega la regla única condicional para la combinación de name y company_id
        $rules['name'] .= 'unique_brand'; //esta en app/Providers/AppServiceProvider

        return $rules;
    }

    public function cancelar()
    {
        $this->open = false;
        $this->reset(['open', 'name', 'image', 'title', 'description', 'keywords']);
    }



    public function save()
    {
        $this->authorize('create', new Brand);

        if ($this->image) {
            $rules = $this->rules;
            $rules['image'] = 'require|image|mimes:jpeg,png|max:2048';
            //$this->validate();
            //$urlimage1 = $this->image1->store('products');
            $urlimage = Storage::disk('s3')->put('fe/' .$this->razonsocial. '/brands', $this->image, 'public');
        } else {

            //$this->validate();
            $urlimage = "fe/default/brands/branddefault.jpg";
        }

        $this->validate();


        //dd($this->state);

        $statee = ($this->state) ? 1 : 0;


        Brand::create([
            'name' => strtoupper($this->name),
            'slug' => Str::slug($this->name),
            'state' => $statee,
            'order' => $this->order,
            'company_id' => $this->companyId, //encontramos la company actual osea la compania del usuario logueado
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            //'image' => $image,
            'image' => $urlimage,
        ]);

        $this->reset(['open', 'name', 'image', 'title', 'description', 'keywords']);

        $this->emitTo('admin.brand-list', 'render');

        $this->emit('alert', 'La marca se creo correctamente');
    }



    public function render()
    {
        $this->authorize('create', new Brand);
        return view('livewire.admin.brand-create');
    }
}
