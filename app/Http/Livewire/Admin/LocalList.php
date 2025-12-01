<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Local;
use Illuminate\Support\Facades\Storage;
use Illuminate\validation\Rule;
use Livewire\WithFileUploads;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocalList extends Component
{

    use WithPagination; //para paginacion
    use AuthorizesRequests; //para permisos
    use WithFileUploads; //para la carga de imagenes
    public $search, $local, $state, $identificador; //identificador para recargar la imagen
    public $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $serie, $inicia, $company_id;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $open_view = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $selectedLocals = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    // Método para seleccionar/deseleccionar todos
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLocals = Local::pluck('id')->mapWithKeys(function ($id) {
                return [$id => true];
            })->toArray();
        } else {
            $this->selectedLocals = [];
        }
        //mapWithKeys(function ($id) { return [$id => true]; })
        //Estamos utilizando el método mapWithKeys para transformar el array de IDs en un array asociativo donde
        //cada ID es la clave y el valor es establecido como verdadero. Esto se hace para representar las marcas seleccionadas
    }


    // Método para eliminar marcas seleccionadas
    public function deleteSelected()
    {
        $this->authorize('delete', Local::class); // Asegúrate de tener permisos para eliminar

        $selectedIds = array_keys(array_filter($this->selectedLocals));

        if ($selectedIds) {
            Local::whereIn('id', $selectedIds)->delete();

            $this->resetSelected();
            $this->emit('alert', 'Los locales seleccionadas se eliminaron correctamente');
        }else {
            $this->emit('alert', 'No hay locales seleccionadas');
        }
    }


    // Método para restablecer la selección después de eliminar
    private function resetSelected()
    {
        $this->selectAll = false;
        $this->selectedLocals = [];
    }

    public function generateReport()
    {
        //dd("Prueba");
        //return Excel::download(new BrandExport(), 'marcas.xlsx');
        //return Excel::download(new BrandExport(), 'marcas.csv', \Maatwebsite\Excel\Excel::CSV);
        //return (new BrandExport())->download();//ponemos la interfas responsable en brandExport y no necesitamos poner downloas
        //return new BrandExport();
    }

    public function mount()
    {
        $this->identificador = rand(); //identificador aleatorio, se usa en el id de la imagen osea en el inputfile
        $this->local = new Local(); //se hace para inicializar el objeto e indicar que image es
        //$this->image = "";
    }

    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    /*estas reglas es para la edicion */
    protected $rules = [
        'local.name' => 'required',
        //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //'local.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Agregamos 'nullable' para permitir valores nulos
        'local.codigopostal' => '',
        'local.address' => '',
        'local.email' => '',
        'local.phone' => '',
        'local.movil' => '',
        'local.anexo' => '',
        'local.serie' => '',
        'local.inicia' => '',
        'local.company_id' => '',
    ];

    /*para cargar la consulta mientras no carga muestra el spiner */
    public function loadLocals()
    {
        $this->readyToLoad = true; //se activa una vez cargado la consulta, esto lo hace laravel por nosotros
    }


    public function email($sort)
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



    public function render()
    {
        $this->authorize('view', new Local);
        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $locals = Local::where('company_id', $companyId)
                ->where('name', 'like', '%' . $this->search . '%')
                ->when($this->state, function ($query) {
                    return $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $locals = [];
        }

        return view('livewire.admin.local-list', compact('locals'));

    }


    public function activar(Local $local)
    {

        //$this->authorize('update', $this->local);

        $this->local = $local;

        $this->local->update([
            'state' => 1
        ]);
    }

    public function desactivar(Local $local)
    {
        $this->authorize('update', $this->local); //tenemos que mandar el error a una pagina
        $this->local = $local;

        $this->local->update([
            'state' => 0
        ]);
    }



}
