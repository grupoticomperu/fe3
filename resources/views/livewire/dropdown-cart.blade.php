<div>
    <div class="offset-cart-area offset-body">
        <div class="offset-heading">
            <h3>Lista del Carrito</h3><i class="close-offset flaticon-letter-x"></i>
        </div>
        <div class="cart-list">
            <table>
                <tbody>
                   {{--  @forelse (Cart::content() as $item) --}}
                   @forelse ($carttx as $item)
                    <tr>
                        <td class="product-img">
                            <div class="pro-img">
                                <img src="/images/products/1.jpg" alt="" />
                            </div>
                        </td>
                        <td>
                            <div class="pro-con">
                                <h4><a href="#">{{ $item['name'] }}</a></h4>
                                {{-- <del>$450</del> --}}
                                <strong>{{ $item['price'] }}</strong>
                            </div>
                        </td>
                        <td>
                            <div class="mr-2 item-pro">
                                <input type="number"
                                id="r{{ $item['name'] }}"
                                wire:change="updateQty('{{ is_numeric($item['name']) ? $item['name'] : addslashes($item['name']) }}', {{ $item['price'] }}, $('#r' + '{{ $item['name'] }}').val() )"
                                value="{{ $item['quantity'] }}">
                            </div>
                        </td>
                        <td>
                            <div class="ml-2 mr-2">
                                Total
                            </div>

                        </td>
                        <td><span class="close"><i class="flaticon-letter-x"></i></span></td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            <p>carrito vacio</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn1 floatright mr-t25">checkout</a>
        </div>
    </div>
</div>
