<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Guiadiseno;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class GuiadisenoEdit extends Component
{

    use WithFileUploads;

    public $name;
    public $nameblade;
    public $image1, $image2;
    public $order;
    public $description;
    public $state = true;
    public $company;
    public $guiadiseno;
    public $image1back, $image2back;


    public function mount(Guiadiseno $guiadiseno)
    {
        $this->company = auth()->user()->employee->company;

        $this->guiadiseno = $guiadiseno;
        // Cargar datos del transportista
        $this->name = $guiadiseno->name;
        $this->nameblade = $guiadiseno->nameblade;
        $this->image1back = $guiadiseno->image1;
        $this->image2back = $guiadiseno->image2;
        $this->order = $guiadiseno->order;
        $this->description = $guiadiseno->description;
        $this->state = $guiadiseno->state;
    }


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',

            'nameblade' => [
                'required',
                'string',
                'max:255',
                Rule::unique('guiadisenos', 'nameblade')->ignore(optional($this->guiadiseno)->id),
            ],

            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'state' => 'boolean',
        ];
    }

    protected $messages = [
        // required / unique
        'name.required' => 'El :attribute es obligatorio.',
        'nameblade.required' => 'El :attribute es obligatorio.',
        'nameblade.unique' => 'El :attribute ya existe, elige otro.',

        // imagen 1

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



    public function update()
    {
        $this->nameblade = trim($this->nameblade);

        $this->validate();

        $folder = 'disenos-comprobantes/facturas';

        $image1 = $this->image1
            ? Storage::disk('s3_public')->put($folder, $this->image1, 'public')
            : $this->image1back;

        $image2 = $this->image2
            ? Storage::disk('s3_public')->put($folder, $this->image2, 'public')
            : $this->image2back;

        $this->guiadiseno->update([
            'name' => $this->name,
            'nameblade' => $this->nameblade,
            'image1' => $image1,  
            'image2' => $image2,
            'description' => $this->description,
            'order' => $this->order,
            'state' => $this->state,
        ]);

        $this->emit('alert', 'El Diseño de la Guia se actualizó correctamente');
        return redirect()->route('admin.guiadiseno.list');
    }

    public function render()
    {
        return view('livewire.admin.guiadiseno-edit');
    }
}
