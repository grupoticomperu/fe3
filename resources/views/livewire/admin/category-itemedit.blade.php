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
                    wire:model="selectedParentCategory" wire:model="deshabilitar" value="{{ $category->id }}"
                    onclick="selectOnlyOneRadio({{ $category->id }})"
                    {{ $selectedParentCategory == $category->id ? 'checked' : '' }}
                    {{ $deshabilitar == 1 ? 'disabled' : '' }}>


                {{-- @if ($selectedParentCategory == $category->id){
                        {{ $deshabilitar = 1 }}
                     }@else{
                         {{ $deshabilitar = 0 }}
                     }
                     @endif --}}



                @if ($selectedParentCategory == $category->id)
                    @php
                        $deshabilitar = 1;
                    @endphp
                @else
                    @php
                        $deshabilitar = 0;
                    @endphp
                @endif





                <span>{{ $category->name }} {{ $selectedParentCategory }} ya{{ $deshabilitar }}</span>
            </div>
        </div>
    </div>
    <ul x-show="open" @click.away="open = true">
        @foreach ($category->children as $child)
            {{-- estaba puesto  category-item  --}}

            <li>
                <div style="margin-left: {{ ($depth + 1) * 20 }}px">
                    <livewire:admin.category-itemedit :category="$child" :deshabilitar="$deshabilitar" :selectedParentCategory="$selectedParentCategory"
                        :key="$child->id" />
                </div>
            </li>
        @endforeach
    </ul>
</div>
