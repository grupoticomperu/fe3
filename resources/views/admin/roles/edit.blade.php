<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Modificando el Rol') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('admin.role.update', $role) }}" >
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div
            class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div>

                            <h3 class="text-center profile-username">Actualizando el Rol</h3>


                            {{--  @include('partials.error-messages') --}}



                            @if ($role->exists)
                            <div class="mb-4">
                                <x-jet-label value="Nombre:" />
                                <x-jet-input type="text" name="name" value="{{ $role->name }}"
                                 class="w-full"
                                 placeholder="nombre del Rol"
                                 disabled />
                                <x-jet-input-error for="name" />
                            </div>
                            @else
                            <div class="mb-4">
                                <x-jet-label value="Nombre:" />
                                <x-jet-input type="text" name="name" value="{{ old('name', $role->name) }}"
                                 class="w-full" />
                                <x-jet-input-error for="name" />
                            </div>
                            @endif

                            <div class="mb-4">
                                <x-jet-label value="Nombre Display:" />
                                <x-jet-input type="text" name="display_name" value="{{ old('display_name', $role->display_name) }}"
                                    placeholder="Nombre del Rol" class="w-full" />
                                <x-jet-input-error for="display_name" />
                            </div>

                            <x-jet-danger-button class="w-full mt-4 mb-3" type="submit">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Rol
                            </x-jet-danger-button>





                        </div>
                    </div>
                </div>

            </div>

            <div class="px-3 py-4 bg-white md:col-span-2">


                <p class="text-lg font-bold underline underline-offset-2">Permisos</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

                    {{-- @include('admin.permissions.checkboxes', ['model' => $user]) --}}
                    @include('admin.permissions.checkboxes', ['model' => $role])



                </div>

                <x-jet-danger-button class="w-full mt-4 mb-3" type="submit">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar Rol
                </x-jet-danger-button>

            </div>

        </div>
    </form>
</x-app-layout>
