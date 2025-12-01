<div>



    <select wire:model="selectedCategory1">
        <option value="null" selected disabled>Seleccione una categoría</option>
        @foreach ($categories1 as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    @if ($selectedCategory1 && count($categories2) > 0)
        <select wire:model="selectedCategory2">
            <option value="null" selected disabled>Seleccione una categoría</option>
            @foreach ($categories2 as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endif

    @if ($selectedCategory2 && count($categories3) > 0)
        <select wire:model="selectedCategory3">
            <option value="null" selected disabled>Seleccione una categoría</option>
            @foreach ($categories3 as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endif

    @if ($selectedCategory3 && count($categories4) > 0)
        <select wire:model="selectedCategory4">
            <option value="null" selected disabled>Seleccione una categoría</option>
            @foreach ($categories4 as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endif

    @if ($selectedCategory4 && count($categories5) > 0)
        <select wire:model="selectedCategory5">
            <option value="null" selected disabled>Seleccione una categoría</option>
            @foreach ($categories5 as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endif

    @if ($selectedCategory5 && count($categories6) > 0)
        <select wire:model="selectedCategory6">
            <option value="null" selected disabled>Seleccione una categoría</option>
            @foreach ($categories6 as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endif

    {{-- <select wire:model="selectedCategory">
        <option value="">Seleccione una categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select> --}}


    {{-- @if ($selectedCategory)
        @livewire('admin.category-selector', ['categoryId' => $selectedCategory], key($selectedCategory))
    @endif --}}
</div>
