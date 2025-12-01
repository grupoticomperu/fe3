<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Menu General') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
               {{--  <a href="{{ route('admin.categories') }}"><h1> Categorias </h1> </a> --}}
                <a href="{{ route('category.list') }}"><h1> Categorias </h1> </a>
                <a href="{{ route('admin.brands') }}"><h1> Marcas </h1> </a>

                <h1> Productos </h1>
            </div>
        </div>
    </div>
</x-app-layout>