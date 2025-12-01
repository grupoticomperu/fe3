<div>

    <x-slot name="menud">
        @include('menud')
   </x-slot>


    <section class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcumb-cont">
                        <h2>Single product</h2>
                        <p>This is Photoshop's version  of Lorem Ipsum. bibendum auctor, nisi elit consequat.</p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcum-nav">
                        <h4>Single product</h4>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li><a href="#">product name</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Breadcumb area end here-->
    <!--Single products area start here-->
    <section class="single-products section">
        <div class="container">
            <div class="row">

                <div wire:ignore class="col-md-5 col-sm-6 col-xs-12">
                    <div class="single-products-slider">
                        <div class="slider-for">
                            <div class="img-slid"><img src="/images/products/1.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/2.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/3.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/4.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/2.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/3.jpg" alt=""/></div>
                        </div>
                        <div class="sliders-nav">
                            <div class="img-slid"><img src="/images/products/1.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/2.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/3.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/4.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/2.jpg" alt=""/></div>
                            <div class="img-slid"><img src="/images/products/3.jpg" alt=""/></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="product-details">
                        <div class="stic">
                            <span class="conlo">In Stock</span>
                            <span class="sto">47 in Stock</span>
                        </div>
                        <h2>{{ $productfamilie->name }}</h2>
                        <div class="ratings">
                            <ul>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul>
                            <span>- 5 Reviews</span>
                        </div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh  velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</p>
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



                        <p>Free shipping on int'l orders usd $150+</p>

                        <a wire:click="addItem" class="btn1 clickable"> COMPRAR </a>
                        <a wire:click="clearCart" class="btn1 clickable"> LIMPIAR </a>

                        <div class="servs">
                            <div class="col-sm-4 pd-l0">
                                <div class="serv-list">
                                    <span><img src="images/icons/8.png" alt=""/></span>
                                    <h5>Satisfied or Money Back</h5>
                                </div>
                            </div>
                            <div class="col-sm-4 pd-l5 pd-r5">
                                <div class="serv-list">
                                    <span><img src="images/icons/9.png" alt=""/></span>
                                    <h5> 30 Day Return Policy </h5>
                                </div>
                            </div>
                            <div class="col-sm-4 pd-r0">
                                <div class="serv-list">
                                    <span><img src="images/icons/10.png" alt=""/></span>
                                    <h5> Guaranteed 5 Day Delivery</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pro-describe">
                        <!-- Nav tabs -->
                        <ul class="navtabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">DESCRIPTION</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">QUESTION</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">About</a></li>
                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Reviews</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh  velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <p class="qus"><span>Q. Proin gravida nibh  velit auctor aliquet?</span></p>
                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh  velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">
                                <h2>About this product</h2>
                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh  velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="settings">
                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh  velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
