<div x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }">
    <div @mousedown="toggle({{ $category->id }})" class="flex items-center cursor-pointer">
    <div @click="open = !open" class="flex items-center cursor-pointer">
        <div style="margin-left: {{ $depth * 20 }}px" class="flex">
            <div class="mr-2" x-show="!open">
                <i class="fas fa-plus"></i>
            </div>
            <div class="mr-2" x-show="open">
                <i class="fas fa-minus"></i>
            </div>
        </div>
        <div>
             <input type="radio" name="category_radio" id="category_radio_{{ $category->id }}"
                   wire:model="selectedParentCategory" value="{{ $category->id }}"
                   onclick="selectOnlyOneRadio({{ $category->id }})"
                   {{ $selectedParentCategory == $category->id ? 'checked' : '' }}>
            <span>{{ $category->name }}  {{-- {{ $selectedParentCategory }} --}} </span>
        </div>
    </div>
    </div>
    <ul x-show="open" @click.away="open = true">
        @foreach ($category->children as $child)
            <li>
                <div style="margin-left: {{ ($depth + 1) * 20 }}px">
                    <livewire:admin.category-item :category="$child" :selectedParentCategory="$selectedParentCategory" :key="$child->id" />
                </div>
            </li>
        @endforeach
    </ul>
</div>




