<div x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }" class="mt-2 mb-4">


    <div @mousedown="toggle({{ $category->id }})" class="flex items-center justify-between cursor-pointer">
        <div @click="open = !open" class="flex items-center cursor-pointer">
            <div style="margin-left: {{ $depth * 30 }}px" class="flex">
                <div class="mr-2" x-show="!open">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="mr-2" x-show="open">
                    <i class="fas fa-minus"></i>
                </div>
                {{-- <div class="flex-shrink-0 h-10 ml-2 mr-2 w-15">
                    @if ($category->image)
                        <img class="object-cover w-20 h-10 rounded-sm" src="{{ url($category->image) }}"
                            alt="{{ $category->name }}">

                    @else
                        <img class="object-cover h-6 rounded-full w-15"
                            src="{{ asset('storage/brands/category-default.jpg') }}" alt="{{ $category->name }}">
                    @endif

                </div> --}}

                <div class="flex-shrink-0 h-10 ml-2 mr-2 w-15 ">
                    @if ($category->image)

                        <img class="object-cover w-20 h-10 rounded-sm"
                        src="{{ Storage::disk('s3')->url($category->image) }}" alt="{{ $category->name }}">
                        {{-- src="{{ url($category->image) }}" alt="{{ $category->name }}"> --}}
                        {{-- src="{{ Storage::url($brand->image) }}" storage//storage/brand/default.jpg  en la bd esta puesto esto 	/storage/brands/default.jpg > --}}
                        {{-- url($brand->image) muestra tal como es la ruta en la bd esta puesto esto 	/storage/brands/default.jpg --}}
                        {{--  {{ Storage::disk("s3")->url($brand->image) }} --}}
                    @else
                        <img class="object-cover h-6 rounded-full w-15"
                            src="{{ asset('storage/brands/category-default.jpg') }}"
                            alt="{{ $category->name }}" class="m-2">
                    @endif
                </div>


                <div>
                    <span>{{ $category->name }} ({{ $category->children->count() }})
                        {{ $selectedParentCategory }}</span>
                </div>



            </div>

        </div>
        {{-- <div class="px-6 py-4 whitespace-nowrap">
            @switch($category->state)
                @case(0)
                    @can('Category Update')
                        <span wire:click="activar({{ $category->id }})"
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                            inactivo
                        </span>
                    @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                            inactivo
                        </span>
                    @endcan
                @break

                @case(1)
                    @can('Category Update')
                        <span wire:click="desactivar({{ $category->id }})"
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                            activo
                        </span>
                    @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                            activo
                        </span>
                    @endcan
                @break

                @default
            @endswitch

        </div> --}}

        <div class="px-6 text-sm font-medium text-right whitespace-nowrap">

            <!-- Botones de edición y eliminación -->
            <a href="{{ route('category.editd', ['categoryId' => $category->id]) }}" class="btn btn-green">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            <form method="POST" action="{{ route('category.destroy', $category) }}" style="display:inline">
                {{ csrf_field() }} {{ method_field('DELETE') }}

                <button class="btn btn-red" onclick="return confirm('¿Estas seguro de querer eliminar la Catgoria?')">
                    <i class="fa-solid fa-trash-can"></i>
                </button>

            </form>

            {{-- <a class="btn btn-red" wire:click="$emit('deleteCategory', {{ $category->id }})">
                <i class="fa-solid fa-trash-can"></i> {{ $category->id }}
            </a> --}}


        </div>
    </div>

    {{-- <hr class="my-2 border-t border-gray-300 dotted"> --}}
    {{-- <hr class="w-full my-2 border-t border-gray-300 dotted"> --}}
    <hr class="w-full my-2 border-t border-gray-300 dotted" style="margin-left: {{ $depth * 30 }}px">

    <ul x-show="open" @click.away="open = true">
        @foreach ($category->children as $child)
            <li>
                <div style="margin-left: {{ ($depth + 1) * 20 }}px">
                    <livewire:admin.category-itemlist :category="$child" :selectedParentCategory="$selectedParentCategory" :key="$child->id" />
                </div>
            </li>
        @endforeach
    </ul>


    {{-- @push('scripts')
        <script src="sweetalert2.all.min.js"></script>

        <script>
            Livewire.on('deleteCategory', categoryId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se podrá revertir!  ya categoryId",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar! '
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.category-listd', 'delete', categoryId);

                        Swal.fire(
                            'Eliminado!',
                            'El Registro fue eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush --}}



</div>
