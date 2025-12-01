<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.role.store') }}" enctype="multipart/form-data">

        @include('admin.roles.form')

{{--         <x-jet-danger-button type="submit" class="mt-4">
            <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Rol
        </x-jet-danger-button> --}}

    </form>


</x-app-layout>
