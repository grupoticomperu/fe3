<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nuava Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <div class="flex flex-wrap mx-4 mt-4">
                    <div class="w-full px-4 mb-4 md:w-4/4">
                        {{-- Renderizar los selectores de categorías --}}

                        <div>
                            <div class="mb-4">
                                <x-jet-label value="categoria" />
                                <x-jet-input type="text" class="w-full" wire:model="name" />
                                <x-jet-input-error for="name" />
                            </div>

                            <h2>Seleccionar Categorías</h2>
                            {{-- @livewire('admin.category-selector') --}}
                            {{--  @livewire('admin.category-selector', ['categoryId' => $selectedCategory], key($selectedCategory)) --}}


                            <select wire:model="selectedCategory1">
                                <option value="null" selected disabled>Seleccione una categoría</option>
                                @foreach ($categories1 as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            {{ $selectedCategory1 }}

                            @if ($selectedCategory1 && count($categories2) > 0)
                                <select wire:model="selectedCategory2">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories2 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory2 }}
                            @endif

                            @if ($selectedCategory2 && count($categories3) > 0)
                                <select wire:model="selectedCategory3">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories3 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory3 }}
                            @endif

                            @if ($selectedCategory3 && count($categories4) > 0)
                                <select wire:model="selectedCategory4">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories4 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory4 }}
                            @endif

                            @if ($selectedCategory4 && count($categories5) > 0)
                                <select wire:model="selectedCategory5">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories5 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory5 }}
                            @endif

                            @if ($selectedCategory5 && count($categories6) > 0)
                                <select wire:model="selectedCategory6">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories6 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory6 }}
                            @endif

                            @if ($selectedCategory6 && count($categories7) > 0)
                                <select wire:model="selectedCategory7">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories7 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory7 }}
                            @endif

                            @if ($selectedCategory7 && count($categories8) > 0)
                                <select wire:model="selectedCategory8">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories8 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory8 }}
                            @endif
                            @if ($selectedCategory8 && count($categories9) > 0)
                                <select wire:model="selectedCategory9">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories9 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory9 }}
                            @endif

                            @if ($selectedCategory9 && count($categories10) > 0)
                                <select wire:model="selectedCategory10">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories10 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory10 }}
                            @endif

                            @if ($selectedCategory10 && count($categories11) > 0)
                                <select wire:model="selectedCategory11">
                                    <option value="null" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categories11 as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $selectedCategory11 }}
                            @endif

                        </div>



                    </div>

                    {{-- Otros campos del formulario para crear una nueva categoría --}}
                    {{-- ... --}}

                    <div class="w-full px-4 mt-6 mb-4">
                        {{-- Botón para crear una nueva categoría --}}
                        <x-jet-danger-button wire:click="save">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Crear Categoria') }}
                            </x-jet-button>

                            {{-- Botón para cancelar la creación de una nueva categoría --}}
                            <x-jet-button wire:click="cancel">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Cancelar') }}
                            </x-jet-button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
