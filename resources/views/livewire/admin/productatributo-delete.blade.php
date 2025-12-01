<div>
    <a class="btn btn-red" wire:click="$emit('deleteProductatribute', {{ $productatribute->id }})" >
        <i class="fa-solid fa-trash-can"></i>

     </a>


     @push('scripts')

     <script src="sweetalert2.all.min.js"></script>


     <script>
      Livewire.on('deleteProductatribute', deleteproductatributeId => {
          Swal.fire({
              title: 'Estas seguro?',
              text: "No se podrá revertir!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Eliminar!'
          }).then((result) => {
              if (result.isConfirmed) {

                  Livewire.emitTo('admin.productatributo-delete','delete', deleteproductatributeId);

                  Swal.fire(
                      'Eliminado!',
                      'El Registro fue eliminado.',
                      'success'
                  )
              }
          })
      })
      </script>





 @endpush



</div>
