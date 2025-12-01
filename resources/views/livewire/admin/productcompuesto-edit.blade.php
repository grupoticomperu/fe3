<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Actualización de Producto Compuesto
            </h2>
        </div
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">



            <x-table>

                {{ $product->name }}


               i {{ $i = 0 }}
            @foreach ( $groupatributes as $groupatribute)
                <div>
                    <h2>{{  $groupatribute->name }}</h2>
                   i {{ $i = $i + 1 }}

                </div>
                j{{ $j = 0 }}
                @foreach ( $groupatribute->atributes as $atribute )
                j{{ $j = $j + 1 }}
                    <x-jet-label>
                        <x-jet-checkbox

                        wire:model.defer="atributesphp"
                        {{-- wire:click="contadores({{$i}}, {{$j}})" --}}
                        name="atributes[]"

                       {{--  value="[{{$atribute->id}}]" /> --}}
                        value="[{{$groupatribute->name}}=>{{$atribute->id}}]"

          {{--               @if("deshabilitar")
                            disabled
                        @else

                        @endif --}}

                     {{--  disabled="{{$atributesphpd[0]}}=={{$atribute->id}} ? true : false" --}}
                       :disabled="in_array( $atribute->id , $atributesphpd ) ? true: false"

                     {{-- {{ disabled="deshabilitar()"}} --}}
                     {{-- disabled="deshabilitar()" --}}

                        {{--   @if($atributesphpd[0])
                    {{ $isDisabled = true }}
                          @endif --}}

                          {{-- @if ($post->featured) checked @endif --}}



        {{--            @foreach ( $atributesphpd as $atributephpd)
                            @if ($atributephpd == $atribute->id)
                             disabled
                            @endif
                        @endforeach --}}


                        />
                        {{--  si activamos el checkbox los datos viajan a atribustesphp
                              si descativamos quita el valor de atribustesphp porque es wiremodel --}}
                        {{$atribute->name}}

                    </x-jet-label>
                @endforeach

            @endforeach



            </x-table>
            <x-jet-danger-button wire:click="crear" wire:loading.attr="disabled" wire:target="crear">
                Crear
            </x-jet-danger-button>

    </div>


    <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


    </x-slot>



</div>
