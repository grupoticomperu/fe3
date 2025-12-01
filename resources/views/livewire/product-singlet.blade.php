<div>


    <div class="container py-8">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
            <div>
                <div class="flexslider">
                    <ul class="slides">

                            <li data-thumb="{{ asset('img/1.jpg') }}">
                                {{-- <img src=" {{ Storage::url($image->url) }}" /> --}}

                                <img class="object-cover w-full h-36" src="{{ asset('img/1.jpg') }}"
                                    alt="{{ $productfamilie->name }}" />
                            </li>


                    </ul>
                </div>


            </div>

            <div>
                <h1 class="mb-5 text-2xl font-bold uppercase text-trueGray-700">{{ $productfamilie->name }}</h1>


                <div class="mb-6 bg-white rounded-lg shadow-lg">



                    <table>
                        <tbody>
                            <tr>
                                <td>Quantity </td>
                                <td><div class="input-group ">
                                    <input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-default"   data-bts-button-up-class="btn btn-default" value="1" name="vertical-spin">
                                </div></td>
                            </tr>
                            <tr>
                                <td>Select Size</td>
                                <td>
                                    <div class="flex">
                                        {{-- <label for="Tallas">Tallas</label> --}}
                                        <select wire:model="tallas_id">
                                            <option value="" selected disabled>Tallas</option>
                                            @foreach ($tallas as $id=>$name)
                                                <option value="{{$name}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p>{{ $tallas_id }} {{ $i }} </p>
                                </td>
                            </tr>
                            <tr>
                                <td>Colours</td>
                                <td>
                                    <div>
                                        {{-- <label for="Colores">Colores</label> --}}
                                        <select wire:model="colores_id" >
                                            <option value="" selected disabled>Colores</option>
                                            @foreach ($colores as $id=>$name)
                                                <option value="{{$name}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <p>{{ $colores_id }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <strong>precio : {{ $price }}</strong>
                    <strong>Stock : {{ $stock }}</strong>
                    <strong>Código : {{ $codigo }}</strong>




                    <a wire:click="addItem" class="cursor-pointer"> COMPRAR </a>
                    <a wire:click="clearCart" class="cursor-pointer"> LIMPIAR </a>







                </div>




            </div>
        </div>
    </div>
</div>
