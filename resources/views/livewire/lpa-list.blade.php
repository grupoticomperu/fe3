<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-slot name="menu">
        @include('menu')
    </x-slot>



    <div><hr></div>

    <div class="shop_section shop_reverse py-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--shop wrapper start-->

                    <!--breadcrumbs area start-->
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">Inicio</a></li>
                            <li>productos</li>
                        </ul>
                    </div>
                    <!--breadcrumbs area end-->

                    <div class="shop_banner d-flex align-items-center" data-bgimg="/assets/img/bg/shop_bg.jpg">
                        <div class="shop_banner_text">
                            <h2>{{ $subcategoria->name }}</h2>

                        </div>
                    </div>
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper d-flex justify-content-between align-items-center">
                        <div class="page_amount">
                            <p><span>1.260</span> Products Found</p>
                        </div>
                        <div class=" sorting_by d-flex align-items-center">
                            <span>SORT BY :</span>
                            <form class="select_option" action="#">
                                <select name="orderby" id="short">

                                    <option selected value="1">NAME 3</option>
                                    <option value="2">NAME 4</option>
                                    <option value="3">NAME 5</option>
                                    <option value="4">NAME 6</option>
                                    <option value="5">NAME 7</option>
                                    <option value="6">NAME 8</option>
                                </select>
                            </form>
                        </div>
                        <div class="toolbar_btn_wrapper d-flex align-items-center">
                            <div class="view_btn">
                                <a class="view" href="#">VIEW</a>
                            </div>
                            <div class="shop_toolbar_btn">
                                <ul class="d-flex align-items-center">
                                    <li><a href="#" class="active btn-grid-3" data-role="grid_3" data-tippy="3"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="top"><i class="ion-grid"></i></a></li>

                                    <li><a href="#" class="btn-list" data-role="grid_list" data-tippy="List"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="top"><i class="ion-navicon"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!--shop toolbar end-->
                    <div class="row shop_wrapper">



                    @foreach ($products as $product)


                           <div class="col-lg-4 col-md-4 col-sm-6">

                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="/assets/img/product/product1.jpg"
                                                alt="">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                                        data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product_label">
                                            <span>-18%</span>
                                        </div>
                                    </div>

                                    <div class="text-center product_content grid_content">
                                        <div class="product_ratting">
                                            <ul class="d-flex justify-content-center">
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><span>(2)</span></li>
                                            </ul>
                                        </div>
                                        <h4 class="product_name"><a href="{{ route('product.single.ecommerce', $product) }}"> {{ $product->name }} </a></h4>
                                        <div class="price_box">
                                            <span class="current_price"> {{ $product->productatributes->min('pricesale') }} </span>
                                            <span class="old_price"> {{ $product->pricesale }} </span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-placement="top">Gregar al carrito</a>
                                        </div>
                                    </div>


                                    <div class="product_list_content">
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <p><a href="#">shows</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="product_desc">
                                            <p>Morbi pulvinar mollis metus, vel tempus orci convallis ut. Vestibulum finibus
                                                posuere orci, sed venenatis sem eleifend et. Vivamus vitae risus vitae orci
                                                vestibulum faucibus condimentum sit amet eros. Sed mattis ligula in tempus
                                                pharetra. Nullam quis augue ac tellus tempor congue</p>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-placement="top">Add To Cart</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach

                        {{-- {{ $products->appends(['subcategory_id' => $subcategoria->id])->links() }} --}}
                      {{--   {{ $products->onEachSide(1)->appends(request()->except('page'))->links() }} --}}
                      {{-- {{ $products->onEachSide(1)->links() }} --}}
                      {{-- {{ $products->links() }} --}}
                    </div>


                    <div class="pagination_style pagination justify-content-center">
                        <ul class="d-flex">
                           {{--  {{ $products->links() }} --}}
                        </ul>
                    </div>





                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>


    <div >
        <hr>
    </div>
</div>
