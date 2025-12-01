<?php

namespace App\Http\Livewire\Admin;

use App\Models\Local;
use App\Models\Tipocomprobante;
use Livewire\Component;
use App\Models\Local_tipocomprobante;

class LocalEdit extends Component
{

    public $local;

    public $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $company_id, $state;
    public $tipocomprobantes, $tipocomprobante_id = "";
    public $serie, $inicio;

    protected $listeners = ['deleteTipocomprobante'];

    public function mount(Local $local)
    {
        //$this->local = $local;
        //$this->tipocomprobantes = Tipocomprobante::pluck('name', 'id');

        $this->local = $local;

        // Obtener los IDs de los tipos de comprobantes asociados al local actual
        $tipocomprobantesAsociados = $local->tipocomprobantes->pluck('id')->toArray();

        // Obtener los tipos de comprobantes que NO están asociados al local actual
        $this->tipocomprobantes = Tipocomprobante::whereNotIn('id', $tipocomprobantesAsociados)->pluck('name', 'id');
    }


    protected $rules = [
        'local.name' => 'required',
        'local.codigopostal' => '',
        'local.address' => '',
        'local.email' => '',
        'local.phone' => '',
        'local.movil' => '',
        'local.anexo' => '',
        'local.company_id' => '',
        'local.state' => ''
    ];


    public function save()
    {
          // Convertir campos a mayúsculas antes de actualizar el modelo
        $this->local->name = strtoupper($this->local->name);
        $this->local->codigopostal = strtoupper($this->local->codigopostal);
        $this->local->address = strtoupper($this->local->address);
        $this->local->email = strtolower($this->local->email);
        $this->local->phone = strtoupper($this->local->phone);
        $this->local->movil = strtoupper($this->local->movil);
        $this->local->anexo = strtoupper($this->local->anexo);

        $this->local->update();
        $this->emit('alert', 'El Local se Modifico correctamente');
        // Redirección a la ruta '/locales'
        return redirect()->route('local.list');
    }




    public function deleteTipocomprobante($tipocomprobanteId)
    {
        // Lógica para eliminar el tipocomprobante con el ID proporcionado
        // Puedes utilizar el método detach en la relación muchos a muchos
        $this->local->tipocomprobantes()->detach($tipocomprobanteId);

        // Vuelve a cargar la relación para actualizar la vista
        //$this->local->load('tipocomprobantes');
        $this->emitTo('admin.local-tipocomprobante', 'render');
        //$this->emitTo('admin.local-edit', 'render');
        $this->emit('recargarPagina');
    }




    public function cancel()
    {
        // Redirecciona a la ruta '/locales'
        return redirect()->route('local.list');
    }


    public function agregarcomprobante()
    {

        $this->validate([
            'tipocomprobante_id' => 'required',
            'serie' => 'required',
            'inicio' => 'required|integer',
        ]);

        $existingSerie = Local_tipocomprobante::where('serie', $this->serie)
                                    ->where('company_id',auth()->user()->employee->company->id)
                                    ->exists();

        if($existingSerie){
            $this->emit('alert', 'La serie ya existe.');
            return;
        }

                /*         $existingComprobante = Localtipocomprobante::where('serie', $this->serie)
                ->whereHas('local', function ($query) {
                    $query->where('company_id', auth()->user()->employee->company_id);
                })
                ->exists();
                */

                /* if ($existingComprobante) {
                    $this->addError('serie', 'La serie ya existe para esta compañía.');
                    return;
                } */


        $comprobanteExistente = $this->local->tipocomprobantes()
            ->where('tipocomprobante_id', $this->tipocomprobante_id)
            ->exists();

        // Si no existe, agregar el nuevo comprobante
        if (!$comprobanteExistente) {
            $this->local->tipocomprobantes()->syncWithoutDetaching([
                $this->tipocomprobante_id => [
                    'serie' => $this->serie,
                    'inicio' => $this->inicio,
                    'company_id' => auth()->user()->employee->company->id,

                ],
            ]);

            // Limpiar los campos del formulario
            $this->reset(['tipocomprobante_id', 'serie', 'inicio']);

            // Emitir un mensaje o realizar otras acciones según sea necesario
            $this->emit('alert', 'El comprobante se agregó correctamente.');



        } else {
            // Mostrar un mensaje o realizar acciones si la combinación ya existe
            $this->addError('tipocomprobante_id', 'Esta combinación ya existe.');
        }


        //$tipocomprobantesAsociados = $this->local->tipocomprobantes->pluck('id')->toArray();
        //$this->tipocomprobantes = Tipocomprobante::whereNotIn('id', $tipocomprobantesAsociados)->pluck('name', 'id');


        $this->emitTo('admin.local-tipocomprobante', 'render');
        $this->emit('recargarPagina');
        //$this->emitTo('admin.local-edit', 'render');no actualiza el select

        // Crear un nuevo comprobante con los datos del formulario
        /* $nuevoComprobante = $this->local->tipocomprobantes()->attach($this->tipocomprobante_id, [
            'serie' => $this->serie,
            'inicio' => $this->inicio,
        ]); */

        // Limpiar los campos del formulario
        //$this->reset(['tipocomprobante_id', 'serie', 'inicio', 'tipocomprobantes']);

        // Emitir un mensaje o realizar otras acciones según sea necesario
        //$this->emit('alert', 'El comprobante se agregó correctamente.');


    }


    public function render()
    {

        $tipocomprobantesAsociados = $this->local->tipocomprobantes->pluck('id')->toArray();

        // Obtener los tipos de comprobantes que NO están asociados al local actual
        $tipocomprobantes  = Tipocomprobante::whereNotIn('id', $tipocomprobantesAsociados)->pluck('name', 'id');

        return view('livewire.admin.local-edit', ['tipocomprobantes' => $tipocomprobantes]);
    }
}
