<x-appwebt-layout>

     <ul class="mx-12">
        @foreach ($categories as $category)
            <li class="flex-1 py-4 mx-6 my-2 space-y-2 bg-white shadow">{{ $category->name }}</li>
            <ul class="mx-12 space-y-2">
            @foreach ($category->childrenCategories as $childCategory)
                @include('child_category', ['child_category' => $childCategory])
            @endforeach
            </ul>
        @endforeach
    </ul>


  <ul class="mx-12">
    @foreach ($categories as $category)
        <li class="flex-1 py-4 mx-6 my-2 space-y-2 bg-white shadow">{{ $category->name }}</li>

    @endforeach
</ul>




</x-appwebt-layout>
