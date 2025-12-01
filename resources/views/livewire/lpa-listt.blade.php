<div>

    <div class="container mt-5">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">



            <div class="md:col-span-2 lg:col-span-4">
                <h1 class="my-4 text-4xl font-bold text-center">Lista de productos</h1>

                    <ul class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                        @forelse ($products as $product)
                            <li class="bg-white rounded-lg shadow">

                                <article class="card">

                                    @if($product->image )

                                                <img class="object-cover w-full h-36" src="" alt="{{ $product->name }}">

                                    @else
                                        <a href="{{ route('product.singlet.ecommerce', $product) }}">
                                            <img class="object-cover w-full h-36" src="{{asset('img/1.jpg')}}"  alt="{{ $product->name }}"">
                                        </a>
                                    @endif


                                    <div class="card-body">
                                        <h1 class="card-title"><a href="{{ route('product.singlet.ecommerce', $product) }}">{{ Str::limit($product->name, 15)}}</a></h1>
                                        {{-- <p class="mb-2 text-sm text-gray-500">Profe: {{$product->name}}</p> --}}

                                    </div>
                                </article>



                            </li>

                        @empty
                            <li class="md:col-span-2 lg:col-span-4">
                                <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                                    <strong class="font-bold">Upss!</strong>
                                    <span class="block sm:inline">No existe ningun Producto</span>
                                </div>
                            </li>
                        @endforelse
                    </ul>





                <div class="mt-4">



                </div>
            </div>

        </div>
    </div>








</div>
