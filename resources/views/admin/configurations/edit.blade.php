<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Configuratión of system') }}
        </h2>

    </x-slot>
    <form method="POST" action="{{ route('admin.configuration.update', $configuration) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div
            class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div>

                            <h3 class="text-center profile-username">Actualizando la Configuración</h3>


                            <div class="mb-4">
                                <x-jet-label value="Nombre:" />
                                <x-jet-input type="text" name="name" value="{{ old('razonsocial', $configuration->razonsocial) }}"
                                 class="w-full"
                                 placeholder="nombre del Rol"
                                 disabled />
                                <x-jet-input-error for="name" />
                            </div>

                            <div class="mb-4">
                                <x-jet-label value="Nombre Display:" />
                                <x-jet-input type="text" name="display_name" value="{{ old('ruc', $configuration->ruc) }}"
                                    placeholder="Nombre del Rol" class="w-full" />
                                <x-jet-input-error for="display_name" />
                            </div>

                            <x-jet-danger-button class="w-full mt-4 mb-3" type="submit">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar la Confiuración
                            </x-jet-danger-button>





                        </div>
                    </div>
                </div>

            </div>



        </div>
    </form>
</x-app-layout>
