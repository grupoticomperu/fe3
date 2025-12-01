<div>
    @foreach($selectedCategories as $index => $categoryId)
        <select wire:change="loadSubcategories({{ $categoryId }})" wire:key="category-{{ $index }}">
            <option value="">Seleccione una categoría</option>
            @foreach($rootCategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @endforeach
</div>
