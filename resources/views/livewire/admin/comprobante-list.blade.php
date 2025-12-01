<div>
    <div wire:init="loadComprobantes">


        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    Lista de Ventas y Comprobantes
                </h2>
            </div>
        </x-slot>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-full py-12 mx-auto border-gray-400 sm:px-6 lg:px-8">

            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

                <div class="flex items-center justify-center mb-2 md:mb-0">
                    <span>Mostrar </span>
                    <select wire:model="cant"
                        class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="10"> 10 </option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="mr-3">registros</span>
                </div>


                <div class="flex items-center justify-center w-full mb-2 mr-4 md:mb-0">
                    <x-jet-input type="text" wire:model="search"
                        class="flex items-center justify-center sm:w-full rounded-lg py-2.5" placeholder="Buscar" />
                </div>

                <div class="flex items-center justify-center mr-2">
                    <a href="{{ route('admin.comprobante.create') }}"
                        class="flex items-center justify-center h-10 px-4 mb-2 text-sm text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 whitespace-nowrap sm:mb-0">
                        <i class="mx-2 fa-regular fa-file"></i>Nuevo
                    </a>
                </div>

                <div class="flex items-center justify-center">
                    <a href="{{ route('admin.comprobante.create') }}"
                        class="flex items-center justify-center h-10 px-4 mb-2 text-sm text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 whitespace-nowrap sm:mb-0">
                        <i class="mx-2 fa-regular fa-file"></i>Boleta Rápida
                    </a>
                </div>

            </div>

            <x-table>





                {{-- @if ($comprobantes->count()) --}}


                @if (count($comprobantes))


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                                <th scope="col"
                                    class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('id')">

                                    ID

                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif
                                </th>





                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('fechaemision')">

                                    Fecha de Emisión
                                    @if ($sort == 'fechaemision')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('razonsocial')">

                                    Razón Social
                                    @if ($sort == 'razonsocial')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>



                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                    wire:click="order('serienumero')">
                                    Serie Número
                                    @if ($sort == 'serienumero')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif


                                </th>


                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider  text-gray-500 uppercase text-right"
                                    wire:click="order('subtotal')">
                                    Subtotal
                                    @if ($sort == 'subtotal')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif


                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    IGV
                                    {{--  @if ($sort == 'igv')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif --}}


                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    Total
                                    {{-- @if ($sort == 'total')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif --}}


                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    PDF
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    XML
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    CDR
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    SUNAT
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($comprobantes as $comprobante)
                                <tr>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $comprobante->id }}
                                    </td>
                                    <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                        {{--  {{ $comprobante->fechaemision }} --}}
                                        {{ \Carbon\Carbon::parse($comprobante->fechaemision)->format('d/m/Y') }}

                                    </td>
                                    <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $comprobante->customer->nomrazonsocial }}

                                    </td>





                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $comprobante->serienumero }}
                                    </td>





                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text-right">
                                        {{-- @isset($comprobante->boleta->currency)
                                                <span>{{ $comprobante->boleta->currency->abbreviation }}</span> {{ $comprobante->boleta->total - $comprobante->boleta->total*0.18  }}
                                            @endisset --}}
                                        @isset($comprobante->currency->abbreviation)
                                            <span>{{ $comprobante->currency->abbreviation }}
                                            </span>{{ number_format($comprobante->valorventa, 2) }}
                                        @endisset
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text-right">
                                        {{-- @isset($comprobante->boleta->currency)
                                            <span>{{ $comprobante->boleta->currency->abbreviation }}</span> {{ $comprobante->boleta->total*0.18 }}
                                            @endisset --}}
                                        @isset($comprobante->currency->abbreviation)
                                            <span>{{ $comprobante->currency->abbreviation }} </span>
                                        @endisset
                                        {{ number_format($comprobante->totalimpuestos, 2) }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text-right">
                                        {{-- @isset($comprobante->boleta->currency)
                                            <span>{{ $comprobante->boleta->currency->abbreviation }}</span> {{ $comprobante->boleta->total }}
                                            @endisset --}}
                                        @isset($comprobante->currency->abbreviation)
                                            <span>{{ $comprobante->currency->abbreviation }} </span>
                                        @endisset
                                        {{ number_format($comprobante->mtoimpventa, 2) }}

                                    </td>

                                    {{-- PDF --}}
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text-right">
                                        {{-- <a href="" ><img class='h-6' src='/images/icons/pdf_cpe.svg'/></a> --}}
                                        {{-- @if ($comprobante->factura->pdf_path)
                                                <a href="{{ asset('storage/' . $comprobante->factura->pdf_path) }} "
                                                    target="_blank"><img class='h-6' src="/images/icons/pdf_cpe.svg"
                                                        alt="comprobante"></a>
                                            @endif --}}
                                        {{-- para mostrar factura es 1 --}}
                                        @if ($comprobante->tipocomprobante_id == 1)
                                            @if ($comprobante->factura->pdf_path)
                                                {{--  <a href="{{ asset('storage/' . $comprobante->factura->pdf_path) }}" //funciona en local --}}
                                                <a href="{{ Storage::disk('s3')->url($comprobante->factura->pdf_path) }}"
                                                    target="_blank">

                                                    <img class='h-6' src="/images/icons/pdf_cpe.svg"
                                                        alt="comprobante">
                                                </a>
                                            @endif
                                        @endif
                                        {{-- para mostrar boleta es 2 --}}
                                        @if ($comprobante->tipocomprobante_id == 2)
                                            @if ($comprobante->boleta->pdf_path)
                                                {{-- <a href="{{ asset('storage/' . $comprobante->boleta->pdf_path) }}" funciona en local --}}
                                                <a href="{{ Storage::disk('s3')->url($comprobante->boleta->pdf_path) }}"
                                                    target="_blank">
                                                    <img class='h-6' src="/images/icons/pdf_cpe.svg"
                                                        alt="comprobante">
                                                </a>
                                            @endif
                                        @endif

                                        {{-- para mostrar nc factura es 3 --}}
                                        @if ($comprobante->tipocomprobante_id == 3)
                                            @if ($comprobante->ncfactura->pdf_path)
                                                {{--  <a href="{{ asset('storage/' . $comprobante->ncfactura->pdf_path) }}" --}}
                                                <a href="{{ Storage::disk('s3')->url($comprobante->ncfactura->pdf_path) }}"
                                                    target="_blank">
                                                    <img class='h-6' src="/images/icons/pdf_cpe.svg"
                                                        alt="comprobante">
                                                </a>
                                            @endif
                                        @endif

                                        {{-- para mostrar nc boleta es 5 --}}
                                        @if ($comprobante->tipocomprobante_id == 5)
                                            @if ($comprobante->ncboleta->pdf_path)
                                                <a href="{{ Storage::disk('s3')->url($comprobante->ncboleta->pdf_path) }}"
                                                    {{-- <a href="{{ asset('storage/' . $comprobante->ncboleta->pdf_path) }}" --}} target="_blank">
                                                    <img class='h-6' src="/images/icons/pdf_cpe.svg"
                                                        alt="comprobante">
                                                </a>
                                            @endif
                                        @endif



                                    </td>
                                    {{-- XML DE la factura, boleta, ncfactura, ncboleta --}}
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{-- para el xml de factura --}}
                                        @if ($comprobante->tipocomprobante_id == 1)
                                            @if ($comprobante->factura->xml_path)
                                                {{-- <a href="{{ asset('storage/' . $comprobante->factura->xml_path) }}" funciona en local --}}
                                                {{-- <a href="{{ Storage::disk('s3')->url($comprobante->factura->xml_path) }}" target="_blank"> //muestra el xml, pero no lo descarga --}}
                                                {{-- <a href="{{ route('download-xml', ['comprobante' => $comprobante->id]) }}"> --}}
                                                <a href="#"
                                                    wire:click.prevent="downloadXml({{ $comprobante->id }})">
                                                    <img class='h-6' src="/images/icons/xml_cdr.svg"
                                                        alt="xml">
                                                </a>

                                                {{--   <a
                                                    href="{{ route('download-xml', ['comprobante' => $comprobante->id]) }}">
                                                    <img class='h-6' src="/images/icons/xml_cdr.svg"
                                                        alt="xml">
                                                </a> --}}
                                            @else
                                                <a href="#"
                                                    wire:click="generateXml({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif
                                        {{-- para el xml de boleta --}}
                                        @if ($comprobante->tipocomprobante_id == 2)
                                            @if ($comprobante->boleta->xml_path)
                                                
                                                {{-- <a href="{{ Storage::disk('s3')->url($comprobante->boleta->xml_path) }}"
                                                    target="_blank">
                                                    <img class='h-6' src="/images/icons/xml_cdr.svg"
                                                        alt="xml">
                                                </a> --}}


                                                <a href="#"
                                                    wire:click.prevent="downloadXml({{ $comprobante->id }})">
                                                    <img class='h-6' src="/images/icons/xml_cdr.svg"
                                                        alt="xml">
                                                </a>
                                            @else
                                                <a href="#"
                                                    wire:click="generateXml({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif

                                        {{-- para el xml de ncfactura --}}
                                        @if ($comprobante->tipocomprobante_id == 3)
                                            @if ($comprobante->ncfactura->xml_path)
                                                <a href="{{ asset('storage/' . $comprobante->ncfactura->xml_path) }}"
                                                    target="_blank"><img class='h-6'
                                                        src="/images/icons/xml_cdr.svg" alt="xml"></a>
                                            @else
                                                <a href="#"
                                                    wire:click="generateXml({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif

                                        {{-- para el xml de ncboleta --}}
                                        @if ($comprobante->tipocomprobante_id == 5)
                                            @if ($comprobante->ncboleta->xml_path)
                                                <a href="{{ asset('storage/' . $comprobante->ncboleta->xml_path) }}"
                                                    target="_blank"><img class='h-6'
                                                        src="/images/icons/xml_cdr.svg" alt="xml"></a>
                                            @else
                                                <a href="#"
                                                    wire:click="generateXml({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif


                                    </td>

                                    {{-- CDR DE la factura --}}
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{-- para el cdr de factura --}}
                                        @if ($comprobante->tipocomprobante_id == 1)
                                            @if ($comprobante->factura->sunat_cdr_path)
                                                {{--  <a href="{{ asset('storage/' . $comprobante->factura->sunat_cdr_path) }}" //en local funciona bien --}}
                                                <a href="{{ Storage::disk('s3')->url($comprobante->factura->sunat_cdr_path) }}"
                                                    target="_blank">
                                                    <img class='h-6' src="/images/icons/cdr.svg" alt="xml">
                                                </a>
                                            @else
                                                <a href="#" wire:click="sendSunat({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif
                                        {{-- para el cdr de boleta --}}
                                        @if ($comprobante->tipocomprobante_id == 2)
                                            @if ($comprobante->boleta->sunat_cdr_path)
                                                {{-- <a href="{{ asset('storage/' . $comprobante->boleta->sunat_cdr_path) }}" // en local funciona bien --}}
                                                <a href="{{ Storage::disk('s3')->url($comprobante->boleta->sunat_cdr_path) }}"
                                                    target="_blank">
                                                    <img class='h-6' src="/images/icons/cdr.svg"
                                                        alt="enviado con CDR"></a>
                                            @else
                                                @if (is_null($comprobante->boleta->resumen_id))
                                                    <a href="#"
                                                        wire:click="sendSunat({{ $comprobante->id }})"><img
                                                            class='h-6' src="/images/icons/get_cdr.svg"
                                                            alt="xml"></a>
                                                @else
                                                    <img class='h-6' src="/images/icons/resumen2.svg"
                                                        alt="enviado con resumen">
                                                @endif
                                            @endif
                                        @endif
                                        {{-- para el cdr de ncfactura --}}
                                        @if ($comprobante->tipocomprobante_id == 3)
                                            @if ($comprobante->ncfactura->sunat_cdr_path)
                                                <a href="{{ asset('storage/' . $comprobante->ncfactura->sunat_cdr_path) }}"
                                                    target="_blank"><img class='h-6' src="/images/icons/cdr.svg"
                                                        alt="enviado con cdr"></a>
                                            @else
                                                <a href="#" wire:click="sendSunat({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif

                                        {{-- para el cdr de ncboleta --}}
                                        @if ($comprobante->tipocomprobante_id == 5)
                                            @if ($comprobante->ncboleta->sunat_cdr_path)
                                                <a href="{{ asset('storage/' . $comprobante->ncboleta->sunat_cdr_path) }}"
                                                    target="_blank"><img class='h-6' src="/images/icons/cdr.svg"
                                                        alt="xml"></a>
                                            @else
                                                <a href="#" wire:click="sendSunat({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif
                                        @endif



                                        {{-- @if ($comprobante->factura && $comprobante->factura->sunat_cdr_path)
                                                <a href="{{ asset('storage/' . $comprobante->factura->sunat_cdr_path) }} "
                                                    target="_blank"><img class='h-6'
                                                        src="/images/icons/xml_cpe.svg" alt="CDR"></a>
                                            @else
                                                <a href="#" wire:click="sendSunat({{ $comprobante->id }})"><img
                                                        class='h-6' src="/images/icons/get_cdr.svg"
                                                        alt="xml"></a>
                                            @endif --}}

                                    </td>
                                    {{-- SUNAT --}}
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        {{-- para ver el estado si se envio o no se envio --}}
                                        @if ($comprobante->tipocomprobante_id == 1)
                                            @if ($comprobante->factura->sunat_cdr_path)
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/check.svg' /></a>
                                            @else
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/stop.svg' /></a>
                                            @endif
                                        @endif

                                        @if ($comprobante->tipocomprobante_id == 2)
                                            @if ($comprobante->boleta->sunat_cdr_path or $comprobante->boleta->resumen_id)
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/check.svg' /></a>
                                            @else
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/stop.svg' /></a>
                                            @endif
                                        @endif

                                        @if ($comprobante->tipocomprobante_id == 3)
                                            @if ($comprobante->ncfactura->sunat_cdr_path)
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/check.svg' /></a>
                                            @else
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/stop.svg' /></a>
                                            @endif
                                        @endif

                                        @if ($comprobante->tipocomprobante_id == 5)
                                            @if ($comprobante->ncboleta->sunat_cdr_path)
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/check.svg' /></a>
                                            @else
                                                <a href="{{-- {{ route('admin.comprobante.edit', $comprobante) }} --}}"><img class='h-6'
                                                        src='/images/icons/stop.svg' /></a>
                                            @endif
                                        @endif

                                    </td>


                                    <td class="flex px-6 py-4 text-sm font-medium text-right whitespace-nowrap">


                                        {{-- @can('Comprobante Update')
                                                <a href=" {{ route('admin.comprobante.edit', $comprobante) }} " class="btn btn-green"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            @endcan --}}

                                        {{--  @can('Comprobante Update') --}}
                                        @if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2)
                                            {{-- @if ($comprobante->boleta->sunat_cdr_path != null or $comprobante->boleta->resumen_id != null or $comprobante->factura->sunat_cdr_path != null) --}}
                                            @if (
                                                ($comprobante->boleta &&
                                                    ($comprobante->boleta->sunat_cdr_path != null || $comprobante->boleta->resumen_id != null)) ||
                                                    ($comprobante->factura && $comprobante->factura->sunat_cdr_path != null))
                                                <a href="{{ route('admin.notadecredito.create', $comprobante->id) }}"
                                                    class="px-4 btn btn-green">NC</a>
                                            @endif
                                        @endif
                                        {{-- @endcan --}}

                                        {{-- @can('Comprobante Update') --}}
                                        @if ($comprobante->tipocomprobante_id == 1 or $comprobante->tipocomprobante_id == 2)
                                            @if (
                                                ($comprobante->boleta &&
                                                    ($comprobante->boleta->sunat_cdr_path != null || $comprobante->boleta->resumen_id != null)) ||
                                                    ($comprobante->factura && $comprobante->factura->sunat_cdr_path != null))
                                                <a href="{{ route('admin.guiaderemision.create', $comprobante->id) }}"
                                                    class="px-4 btn btn-orange">GR</a>
                                            @endif
                                        @endif
                                        {{--  @endcan --}}


                                        {{-- <a href="" class="text-sm btn btn-orange">GR</a> --}}






                                        {{-- <img class='h-6' src='/images/icons/xml_cdr.svg'/> --}}

                                        {{-- @can('delete User') --}}

                                        {{-- <a class="btn btn-red"
                                                wire:click="$emit('deleteUser', {{ $userr->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a> --}}
                                        {{--  @endcan --}}

                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>




                    @if ($comprobantes->hasPages())
                        <div class="px-6 py-4">
                            {{ $comprobantes->links() }}
                        </div>
                    @endif
                @else
                    {{-- <div wire:init="loadUsers">

                                </div> --}}


                    @if ($readyToLoad)
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                No hay ningún registro coincidente
                            </div>
                        </div>
                    @else
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" fill="blue">

                                    <path
                                        d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z" />
                                </svg>
                            </div>
                        </div>

                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                Cargando, espere un momento
                            </div>
                        </div>
                    @endif




                @endif





            </x-table>

        </div>


        <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                TICOM SOFTWARE
            </h2>


        </x-slot>






        @push('scripts')
        @endpush

    </div>

</div>
