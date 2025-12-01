<x-app-layout>



    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Boletas del resumen {{ $resumen->id }}
            </h2>
        </div </x-slot>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-full py-12 mx-auto border-gray-400 sm:px-6 lg:px-8">

            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">


                <div class="flex items-center justify-center">
                    <a href="{{ route('admin.resumen.list') }}"
                        class="items-center justify-center sm:flex btn btn-orange">
                        <== Regresar </a>
                </div>

            </div>

            <x-table>





                {{-- @if ($comprobantes->count()) --}}


                @if (count($boletas))


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                                <th scope="col"
                                    class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                                    ID


                                </th>





                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                                    Fecha Emisión

                                </th>




                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Total



                                </th>






                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Serie

                                </th>






                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($boletas as $boleta)
                                <tr>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $boleta->id }}
                                    </td>
                                    <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                        {{--  {{ $boleta->fechaemision }} --}}
                                        {{ \Carbon\Carbon::parse($boleta->fechaemision)->format('d/m/Y') }}

                                    </td>


                                    <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $boleta->total }}

                                    </td>

                                    <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $boleta->serie }}

                                    </td>

                                    <td class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">

                                        <a href="#" class="btn btn-blue ">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>



                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $boletas->links() }}
                    </div>
                @else
                    <p class="text-gray-500">No se encontraron boletas.</p>

                @endif


            </x-table>

        </div>


        <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                TICOM SOFTWARE
            </h2>


        </x-slot>


</x-app-layout>
