<?php

namespace App\Http\Livewire\Admin;

use App\Models\Boletadiseno;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class BoletadisenoCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $nameblade;
    public $image1, $image2;
    public $order;
    public $description;
    public $state = true;
    public $company;


    public function mount()
    {
        $this->company = auth()->user()->employee->company;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'nameblade' => 'required|string|max:255|unique:boletadisenos,nameblade',
        'image1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'description' => 'nullable|string',
        'order' => 'nullable|integer',
        'state' => 'boolean',
    ];

    protected $messages = [
        // required / unique
        'name.required' => 'El :attribute es obligatorio.',
        'nameblade.required' => 'El :attribute es obligatorio.',
        'nameblade.unique' => 'El :attribute ya existe, elige otro.',

        // imagen 1
        'image1.required' => 'La :attribute es obligatoria.',
        'image1.image' => 'La :attribute debe ser una imagen válida.',
        'image1.mimes' => 'La :attribute debe ser JPG o PNG.',
        'image1.max' => 'La :attribute no debe pesar más de 2MB.',

        // imagen 2 (opcional, pero si la suben debe cumplir)
        'image2.image' => 'La :attribute debe ser una imagen válida.',
        'image2.mimes' => 'La :attribute debe ser JPG o PNG.',
        'image2.max' => 'La :attribute no debe pesar más de 2MB.',

        // otros
        'description.string' => 'La :attribute debe ser un texto válido.',
        'order.integer' => 'El :attribute debe ser un número entero.',
        'state.boolean' => 'El :attribute debe ser verdadero o falso.',
    ];

    protected $validationAttributes = [
        'name' => 'nombre del diseño',
        'nameblade' => 'nombre de la vista',
        'image1' => 'imagen principal',
        'image2' => 'imagen secundaria',
        'description' => 'descripción',
        'order' => 'orden',
        'state' => 'estado',
    ];


    public function save()
    {

        $this->validate(); // ✔ Ejecuta validaciones

        $urlimage1 = Storage::disk('s3_public')->put('fe/' . $this->company->razonsocial . '/disenos', $this->image1, 'public');


        if ($this->image2) {
      
            $urlimage2 = Storage::disk('s3')->put('fe/' . $this->company->razonsocial . '/disenos', $this->image2, 'public');
        } else {
            $urlimage2 = 'fe/default/products/productdefault.jpg';
        }



        Boletadiseno::create([
            'name' => $this->name,
            'nameblade' => $this->nameblade,
            'image1' => $urlimage1,
            'image2' => $urlimage2,
            'description' => $this->description,
            'order' => $this->order,
            'state' => $this->state,
        ]);


        $this->emit('alert', 'El Diseño de Boleta se creo correctamente');
        return redirect()->route('admin.boletadiseno.list');
    }




    public function render()
    {
        return view('livewire.admin.boletadiseno-create');
    }
}
