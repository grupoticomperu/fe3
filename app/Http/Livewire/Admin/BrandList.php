<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Exports\BrandExport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\validation\Rule;
use App\Models\Configuration;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BrandList extends Component
{
    use WithPagination; //para paginacion
    use AuthorizesRequests; //para permisos
    use WithFileUploads; //para la carga de imagenes
    public $search, $image, $brand, $state, $identificador; //identificador para recargar la imagen

    public $order, $title, $description, $keywords;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $open_view = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $selectedBrands = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo
    public $companyId;
    public $razonsocial;
    public $imageback;

    protected $listeners = ['render', 'delete']; //escuchando y ejecutando los eventos render y delete

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    public function mount()
    {
        $this->identificador = rand(); //identificador aleatorio, se usa en el id de la imagen osea en el inputfile
        $this->brand = new Brand(); //se hace para inicializar el objeto
        $this->image = "";
        $this->companyId = auth()->user()->employee->company->id;
        $this->razonsocial = auth()->user()->employee->company->razonsocial;
    }

    // Método para seleccionar/deseleccionar todos
    public function updatedSelectAll($value)
    {
        //dd($value);
        if ($value) {
            $this->selectedBrands = Brand::where('company_id', $this->companyId)->pluck('id')->mapWithKeys(function ($id) {
                return [$id => true];
            })->toArray();
        } else {
            $this->selectedBrands = [];
        }
    }

    // Método para eliminar marcas seleccionadas
    public function deleteSelected()
    {
        $this->authorize('delete', Brand::class); // Asegúrate de tener permisos para eliminar

        $selectedIds = array_keys(array_filter($this->selectedBrands));



        if ($selectedIds) {
            Brand::whereIn('id', $selectedIds)->delete();
            $this->resetSelected();
            $this->emit('alert', 'Las marcas seleccionadas se eliminaron correctamente');
        } else {
            $this->emit('alert', 'No hay marcas seleccionadas');
        }
    }

    // Método para restablecer la selección después de eliminar
    private function resetSelected()
    {
        $this->selectAll = false;
        $this->selectedBrands = [];
    }


    public function generateReport()
    {

        return new BrandExport();
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    /*estas reglas es para la edicion */
    protected $rulesborrar = [
        'brand.name' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //'brand.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Agregamos 'nullable' para permitir valores nulos
        'brand.state' => 'required',
        //'brand.company_id' => '',
        'brand.order' => '',
        'brand.title' => '',
        'brand.description' => '',
        'brand.keywords' => '',
    ];





    /*para cargar la consulta mientras no carga muestra el spiner */
    public function loadBrands()
    {
        $this->readyToLoad = true; //se activa una vez cargado la consulta, esto lo hace laravel por nosotros
    }

    public function render()
    {
        $this->authorize('view', new Brand);
        //$companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $brands = Brand::where('company_id', $this->companyId)
                ->where('name', 'like', '%' . $this->search . '%')
                ->when($this->state, function ($query) { /* Esta línea utiliza el método when de Laravel para condicionalmente aplicar una cláusula where en la consulta Eloquent. Si $this->state es verdadero (es decir, tiene un valor que se evalúa como verdadero en PHP), entonces se agrega la cláusula where que filtra los registros donde el campo state es igual a 1. */
                    return $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $brands = [];
        }
        return view('livewire.admin.brand-list', compact('brands'));
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


    public function activar(Brand $brand)
    {

        $this->authorize('update', $this->brand);

        $this->brand = $brand;

        $this->brand->update([
            'state' => 1
        ]);
    }

    public function desactivar(Brand $brand)
    {
        $this->authorize('update', $this->brand); //tenemos que mandar el error a una pagina
        $this->brand = $brand;

        $this->brand->update([
            'state' => 0
        ]);
    }

    public function delete(Brand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();
    }


    public function edit(Brand $brand)
    {
        $this->authorize('update', $this->brand);
        $this->brand = $brand;
        $this->open_edit = true;
    }

    public function show(Brand $brand)
    {
        $this->brand = $brand;
        $this->open_view = true;
    }


    public function cancelar()
    {
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->open_edit = false;
    }

    public function cerrar()
    {
        $this->reset('open_view');
    }



    protected function rules()
    {
        return [
            'brand.name' => 'required|string|max:100',
            'brand.state' => 'required|boolean',
            'brand.order' => 'nullable|integer',
            'brand.title' => 'nullable|string|max:255',
            'brand.description' => 'nullable|string|max:500',
            'brand.keywords' => 'nullable|string|max:255',
            'image' => $this->image
                ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                : 'nullable',
        ];
    }



    public function update()
    {
        $this->authorize('update', $this->brand);

        $this->validate();

        if ($this->image) {
            $path = Storage::disk('s3')->put('fe/' . $this->razonsocial . '/brands', $this->image, 'public');
            $this->brand->image = $path;
        }

        $this->brand->name = strtoupper($this->brand->name);
        $this->brand->save();

        // 🔹 Aquí está la clave: Reinicializamos el modelo correctamente
        $this->brand = new Brand();

        // 🔹 Limpiamos otras propiedades
        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();

        $this->emit('alert', 'La marca se modificó correctamente');
    }




    public function updatexborrar()
    {
        $this->authorize('update', $this->brand);

        $this->validate();
        if ($this->image) { //verifica si selecciono imagen

            $this->brand->image = $this->image
                ? Storage::disk('s3')->put('fe/' . $this->razonsocial . '/brands', $this->image, 'public')
                : $this->imageback;
        }

        $this->brand->name = strtoupper($this->brand->name);

        $this->brand->save();

        //esto es la forma de guardar la actiualizacion dato por dato
        /*  $this->brand->save([
            'name' => $this->brand->name,
            'slug' => Str::slug($this->brand->slug),
            'state' => $this->brand->statee,
            'order' => $this->brand->order,
            'comany_id' => auth()->user()->employee->company->id,
            //'image' => $image,
            'image' => $this->brand->image,
        ]); */

        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->emitTo('show-brands', 'render');
        $this->emit('alert', 'La marca se modificó correctamente');
    }
}
