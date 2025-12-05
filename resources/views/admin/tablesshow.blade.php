<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Menu General') }}
        </h2>
    </x-slot>




    <section class="">

        <div class="py-12">
            {{--  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8"> --}}
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}

            <div
                class="grid grid-cols-1 px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-6 gap-y-8">

                @can('Configuration View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/configuraciones.jpg') }}"
                                alt="Configuraciones">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.company.edit', auth()->user()->employee->company->id) }}">Configuraciones</a>
                            </h1>
                        </header>
                    </article>
                @endcan

                @can('User View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/usuarios.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.user.index') }}">Usuarios</a></h1>
                        </header>

                    </article>
                @endcan

                @can('Permission View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/permisos.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('permission.list') }}">Permisos</a></h1>
                        </header>

                    </article>
                @endcan

                @can('Role View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/roles.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.role.index') }}">Roles</a></h1>
                        </header>

                    </article>
                @endcan


                @can('Local View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/locals.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a href="{{ route('local.list') }}">Locales</a>
                            </h1>
                        </header>

                    </article>
                @endcan



                {{-- @can('Local View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/brands.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('local.list')}}">Tipo Comprobantes de Local</a></h1>
                                    </header>

                                </article>
                                @endcan --}}


                @can('Brand View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/brands.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a href="{{ route('brand.list') }}">Marcas</a>
                            </h1>
                        </header>

                    </article>
                @endcan

                @can('Category View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/categories.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('category.listd') }}">Categorias</a></h1>

                        </header>

                    </article>
                @endcan


                {{-- @can('Subcategory View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/categories.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('category.list')}}">Sub Categorias</a></h1>

                                    </header>

                                </article>
                                @endcan --}}


                @can('Modelo View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/modelos.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a href="{{ route('modelo.list') }}">Modelos</a>
                            </h1>
                        </header>

                    </article>
                @endcan


                @can('Product View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/productservice2.jpg') }}"
                                alt="TICOMSOFTWARE">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('product.list') }}">Productos</a></h1>
                        </header>

                    </article>
                @endcan


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/customers.jpg') }}"
                            alt="TICOMSOFTWARE">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a
                                href="{{ route('customer.list') }}">Clientes</a></h1>
                    </header>

                </article>


                {{--  @can('Inventory View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/inventario2.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('inventory.list2')}}">Inventarios</a></h1>
                                    </header>

                                </article>
                                @endcan

                                @can('Shopping View')
                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/compras.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('admin.shopping.index')}}">Compras</a></h1>
                                    </header>

                                </article>
                                @endcan

                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/ingresodemercaderias.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700">Ingreso de Mercaderias</h1>
                                    </header>

                                </article>

                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/trasladodemercaderias.jpg')}}" alt="Envio de Mercaderias">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('admin.shipment.index')}}">Envío de Mercaderias</a></h1>
                                    </header>

                                </article> --}}

                @can('Transportista View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36"
                                src="{{ asset('img/recepciondemercaderias.jpg') }}" alt="Recepción de Mercaderias">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('transportista.list') }}">Transportistas</a></h1>
                        </header>

                    </article>
                @endcan



                @can('Transportista View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36"
                                src="{{ asset('img/recepciondemercaderias.jpg') }}" alt="Recepción de Mercaderias">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('puntodepartida.list') }}">Punto de Partida</a></h1>
                        </header>

                    </article>
                @endcan


                @can('Conductor View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36"
                                src="{{ asset('img/recepciondemercaderias.jpg') }}" alt="Recepción de Mercaderias">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('conductor.list') }}">Conductores</a></h1>
                        </header>

                    </article>
                @endcan


                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36"
                            src="{{ asset('img/recepciondemercaderias.jpg') }}" alt="Veh+iculos">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a
                                href="{{ route('vehiculo.list') }}">Vehículos</a></h1>
                    </header>

                </article>




                @can('Sale View')
                    <article>
                        <figure>
                            <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/pos.jpg') }}"
                                alt="">
                        </figure>
                        <header class="mt-2">
                            <h1 class="text-xl text-center text-gray-700"><a
                                    href="{{ route('admin.comprobante.list') }}">POS</a></h1>
                        </header>

                    </article>
                @endcan

                {{-- @can('Sale View') --}}
                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/1.jpg') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a
                                href="{{ route('admin.resumen.list') }}">Resumenes</a></h1>
                    </header>

                </article>
                {{-- @endcan --}}

                <article>
                    <figure>
                        <img class="object-cover w-full rounded-xl h-36" src="{{ asset('img/pos.jpg') }}"
                            alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-xl text-center text-gray-700"><a
                                href="{{ route('admin.guia.list') }}">Guias</a></h1>
                    </header>

                </article>



                {{-- <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/ecommerce.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700">Web</h1>
                                    </header>

                                </article>

                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/stockdeproductos.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700"><a href="{{route('localproductatributestock.list', auth()->user()->employee->local->id )}}">Stock</a></h1>
                                    </header>

                                </article>

                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/1.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700">Marcas</h1>
                                    </header>

                                </article>

                                <article>
                                    <figure>
                                        <img class="object-cover w-full rounded-xl h-36" src="{{asset('img/1.jpg')}}" alt="">
                                    </figure>
                                    <header class="mt-2">
                                        <h1 class="text-xl text-center text-gray-700">Sub-Categorias</h1>
                                    </header>

                                </article> --}}


            </div>
            {{-- </div> --}}
            {{-- </div> --}}
        </div>




    </section>



    <section class="content-center">
        <div class="mt-4 bg-white shadow ">
            <p class="p-2 text-center">TICOM SOFTWARE - FACTURACIÓN ELECTRÓNICA</p>
        </div>
    </section>

</x-app-layout>
