{{ csrf_field() }}
        <div class="grid w-full grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            <div class="flex px-3 bg-white">
                <div class="w-full mb-4">
                    <x-jet-label value="Nombre:" />
                    <x-jet-input type="text" name="name" value="{{ old('name') }}"
                        placeholder="tu  nombre"
                        class="w-full" />
                    <x-jet-input-error for="name" />
                </div>
            </div>
            <div class="flex px-4 bg-white">
                <div class="w-full mb-4">
                    <x-jet-label value="Descripción:" />
                    <x-jet-input type="text" name="display_name" value="{{ old('display_name') }}"
                        placeholder="tu  nombre"
                        class="w-full" />
                    <x-jet-input-error for="display_name" />
                </div>
            </div>
            <div class="flex px-4 bg-white">
                <div class="mb-4">
                    <x-jet-danger-button type="submit" class="mt-4">
                        <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Rol
                    </x-jet-danger-button>
                </div>
            </div>
        </div>
        <div class="px-3 bg-white">
        <div class="grid w-full grid-cols-1 px-4 pt-4 pb-6 mx-auto mt-4 mb-6 bg-white sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

              @include('admin.permissions.checkboxes',['model'=>$role])

        </div>
        </div>
