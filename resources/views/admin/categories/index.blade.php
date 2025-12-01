<style>
    ul {
        list-style-type: none;
        /* Elimina las viñetas de la lista */
    }
</style>
<ul>

    @foreach ($categories as $category)
        <li>
            {{ $category->name }}
            {{-- @if ($category->depth > 0) --}}
                {{-- Mostrar espacios según la profundidad --}}

            @if($category->children)

            @endif

                @for ($i = 0; $i < $category->depth; $i++)
                    &nbsp;&nbsp;
                @endfor
                {{ $category->name }}
           {{--  @endif --}}





        </li>
    @endforeach
</ul>


{{-- <ul>
    @foreach ($categories as $category)
        <li>
            {{ $category->name }}
            @if ($category->childrenCategories->isNotEmpty())
                @include('admin.categories.partials', ['categories' => $category->childrenCategories])
            @endif
        </li>
    @endforeach
</ul> --}}
