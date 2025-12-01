<x-app-layout>

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

    <div>
        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="mr-10 text-xl font-semibold leading-tight text-gray-600">
                    imágenes para: {{ $productatribute->productfamilie->name}} ,


                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                        @foreach ($productatribute->atributes as $atribute)
                        {{-- pone guion en tallas y colores --}}
                        {{ $atribute->name}}
                            @if (!$loop->last)
                            -
                            @endif

                        @endforeach

                    </td>


                </h2>





            </div
        </x-slot>

        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">


                    <div class="flex flex-col content-center px-10 mb-4">

                        <form method="POST" action="{{route('admin.productatribute.storeimage', $productatribute)}}" enctype="multipart/form-data" id="dropzone" class="flex flex-row items-center justify-center w-full border-2 border-dashed rounded dropzone h-72">
                            @csrf
                        </form>



                         <div class="grid content-center grid-cols-1 mt-5 ">
                            <a class="w-full px-4 py-2 text-xs font-semibold tracking-widest text-center text-white uppercase transition bg-red-800 border border-transparent rounded-md hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 " href="{{ route('admin.productatribute.addimage', $productatribute ) }}" >
                                <i class="mx-2 fa-regular fa-file"></i> guardar imagen
                            </a>

                        </div>


                    </div>

                           {{-- <input type="hidden" name="imagen"> --}}



                     <section class="mt-16">

                        <div class="grid grid-cols-1 px-4 mx-auto gap-x-1 max-w-7xl sm:px-6 lg:px-8 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-y-2">
                            @forelse($productatribute->images as $photo)
                            <div>
                                <form method="POST" action="{{ route('admin.productatribute.destroyimage', $photo)}}">
                                    {{ method_field('DELETE') }} {{ csrf_field() }}
                                    <article class="my-4">
                                        <button class="px-4 py-2 font-bold text-white bg-red-600 rounded hover:bg-red-700" style="position:absolute">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                        <figure>
                                            <img class="object-cover w-36 rounded-xl" src="{{ asset($photo->url) }}" alt="">
                                        </figure>

                                    </article>

                                </form>
                            </div>
                            @empty
                                <div class="flex justify-center col-span-5 my-3 ">
                                    <div class="px-4 py-2 m-2 text-center text-gray-700 bg-gray-400 ">
                                        Aún no tienes imagenes para este producto... <i class="fa-regular fa-face-frown"></i></div>



                                </div>
                            @endforelse
                        </div>
                    </section>



        </div>

    </div>




    </x-app-layout>
