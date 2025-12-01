<div>
     <x-slot name="menud">
        @include('menud')
    </x-slot>
    {{-- Care about people's approval and you will be their prisoner. --}}


     <section class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcumb-cont">
                        <h2>Mi Cesta</h2>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat.</p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcum-nav">
                        <h4>Mi Cesta</h4>
                        <ul>
                            <li><a href="/">inicio</a></li>
                            <li><a href="#">Mi Cesta</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-page section">

        <div class="container">
            <div class="row">
                <form action="#">
                    <div class="table-content cart-table-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{ $carttx }}
                                @foreach ($carttx as $item )
                                <tr>
                                    <td>
                                        <a href="product-left-sidebar.html">
                                            <img class="mr-4" width="40px" src="/images/products/1.jpg" alt=""> {{ $item['name'] }} - {{ $item['talla'] }} -{{ $item['color'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="amount">{{ $item['price'] }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            {{-- <input type="number" class="form-control" name="cant" value="{{ $item['quantity'] }}" min="0"> --}}
                                            @livewire('update-cart-item', ['id' => $item['id'] ], key($item['id']))
                                        </div>
                                    </td>
                                    <td class="amount">{{ $item['price'] * $item['quantity'] }}</td>
                                    <td >
                                        <a href="#"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                @endforeach



                                <tr class="total-row">
                                    <td></td> <!-- Deja esta celda vacía para alinear correctamente las columnas -->
                                    <td></td>
                                    <td>Total:</td>
                                    <td style="font-weight: bold;">$168.00</td> <!-- Ajusta el valor del total según corresponda -->
                                    <td></td> <!-- Deja esta celda vacía para alinear correctamente las columnas -->
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="gi-cart-update-bottom">

                                <a href="#" class="btn1 floatleft mr-t25">Continuar Comprando</a>
                                <a href="#" class="btn1 floatright mr-t25">checkout</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>











    <p>@livewire('total-product')</p>



</div>
