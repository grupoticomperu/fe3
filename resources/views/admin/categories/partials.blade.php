<ul>
    @foreach ($subcategories as $subcategory)
        <li>
            {{ $subcategory->name }}
            @if ($subcategory->descendants->count() > 0)
                @include('admin.categories.partials', ['subcategories' => $subcategory->descendants])
            @endif
        </li>
    @endforeach
</ul>
