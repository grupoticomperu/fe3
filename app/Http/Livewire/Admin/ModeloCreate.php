<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Modelo;
use Illuminate\Support\Str;

class ModeloCreate extends Component
{

    public $open = false;
    public $name, $state;

    protected $rules = [
        'name'=> 'required|unique:modelos',
    ];


    public function save(){
        $this->validate();
        
        //dd($this->state);

        $statee = ($this->state) ? 1 : 0 ;


        Modelo::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'state' => $statee,
        ]);
        
        $this->reset(['open','name']);

        $this->emitTo('admin.modelo-list','render');
        
        $this->emit('alert','El modelo se creo correctamen');
    }



    public function render()
    {
        return view('livewire.admin.modelo-create');
    }




}
