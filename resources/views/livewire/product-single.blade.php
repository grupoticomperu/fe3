<div>

    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-slot name="menu">
         @include('menu')
    </x-slot>

    <div>
        <hr>
    </div>



    <!--breadcrumbs area start-->
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area pt-95">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">home</a></li>
                            <li><a href="shop.html">shop</a></li>
                            <li>Product Example</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <section class="product_details">
        <div class="container">
            <div class="row">

                <div wire:ignore class="col-lg-6 col-md-6">
                    <div class="product_zoom_gallery">
                        <div class="zoom_gallery_inner d-flex">
                            <div class="zoom_tab_img">
                                <a class="zoom_tabimg_list" href="javascript:void(0)"><img
                                        src="/assets/img/product/small-product/product1.png" alt="tab-thumb"></a>
                                <a class="zoom_tabimg_list" href="javascript:void(0)"><img
                                        src="/assets/img/product/small-product/product2.png" alt="tab-thumb"></a>
                                <a class="zoom_tabimg_list" href="javascript:void(0)"><img
                                        src="/assets/img/product/small-product/product3.png" alt="tab-thumb"></a>
                                <a class="zoom_tabimg_list" href="javascript:void(0)"><img
                                        src="/assets/img/product/small-product/product4.png" alt="tab-thumb"></a>
                            </div>
                            <div class="product_zoom_main_img">
                                <div class="product_zoom_thumb">
                                    <img data-image="/assets/img/product/big-product/product1.png"
                                        src="/assets/img/product/big-product/product1.png" alt="">
                                </div>
                                <div class="product_zoom_thumb">
                                    <img data-image="/assets/img/product/big-product/product2.png"
                                        src="/assets/img/product/big-product/product2.png" alt="">
                                </div>
                                <div class="product_zoom_thumb">
                                    <img data-image="/assets/img/product/big-product/product3.png"
                                        src="/assets/img/product/big-product/product3.png" alt="">
                                </div>
                                <div class="product_zoom_thumb">
                                    <img data-image="/assets/img/product/big-product/product4.png"
                                        src="/assets/img/product/big-product/product4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">

                            <div>

                                {{-- {{ $atributes['Tallas'][0] }} --}}
                            </div>

                            <h1>{{ $productfamilie->name }} </h1>

                         {{--    {{ $tallas }} --}}

                             <h1>Selecciona un Atributo:</h1>



                             <div class="flex">
                                {{-- <label for="Tallas">Tallas</label> --}}
                                <select wire:model="tallas_id">
                                    <option value="" selected disabled>Tallas</option>
                                    @foreach ($tallas as $id=>$name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <p>{{ $tallas_id }}</p>

                            <br>
                            <hr>

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


                            <p>precio : {{ $price }}</p>

                            <p>Stock : {{ $stock }}</p>

                            <p>Código : {{ $codigo }}</p>
                            <br>
                            <hr>
                            <ul>
                                <div>

                                    <p>{{ $productfamilie->description }}</p>




                                </div>
                            </ul>




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product details end-->

    <!--product info start-->
    <div class="mb-0 product_d_info pt-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button border-bottom">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-bs-toggle="tab" href="#info" role="tab"
                                        aria-controls="info" aria-selected="false">Product Description</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                        aria-selected="false">Reviews</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#tags" role="tab" aria-controls="tags"
                                        aria-selected="false">Tags </a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#additional" role="tab"
                                        aria-controls="additional" aria-selected="false">Additional Information</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#tabinfo" role="tab" aria-controls="tabinfo"
                                        aria-selected="false">Custom Tab Info</a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tab" href="#video" role="tab" aria-controls="video"
                                        aria-selected="false">Custom Tab Video</a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    <p>Morbi neque arcu, efficitur non porta eu, laoreet sit amet diam. Mauris quis
                                        massa sed mauris dapibus accumsan id quis nulla. <br> Quisque id est sit amet
                                        neque auctor suscipit ut a mauris. Phasellus semper felis sit amet ornare
                                        congue. <br> Mauris bibendum, tortor eu interdum commodo, ex purus pulvinar sem,
                                        ut consequat nunc nisi at est.</p>
                                    <ul>
                                        <li>Length: 74cm</li>
                                        <li>Regular fit</li>
                                        <li>Notched lapels</li>
                                        <li>Twin button front fastening</li>
                                        <li>Front patch pockets; chest pocket</li>
                                        <li> Internal pockets</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="reviews_wrapper">
                                    <h2>1 review for Donec eu furniture</h2>
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="assets/img/blog/comment2.jpg" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                    <ul class="d-flex">
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p><strong>admin </strong>- September 12, 2021</p>
                                                <span>roadthemes</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="comment_title">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published. Required fields are marked </p>
                                    </div>
                                    <div class="mb-10 product_ratting">
                                        <h3>Your rating</h3>
                                        <ul class="d-flex">
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_review_form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">Your review </label>
                                                    <textarea name="comment" id="review_comment"></textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="author">Name</label>
                                                    <input id="author" type="text">

                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="email">Email </label>
                                                    <input id="email" type="text">
                                                </div>
                                            </div>
                                            <button type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tags" role="tabpanel">
                                <div class="product_info_content">
                                    <ul>
                                        <li>Length: 74cm</li>
                                        <li>Regular fit</li>
                                        <li>Notched lapels</li>
                                        <li>Twin button front fastening</li>
                                        <li>Front patch pockets; chest pocket</li>
                                        <li> Internal pockets</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="additional" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first_child">Compositions</td>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td>Girly</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Vivamus vel leo et felis dictum sodales. Duis finibus placerat consectetur. Sed
                                        magna ligula, molestie vitae faucibus sed, consequat ut nisl. Donec at dui
                                        tellus. Nullam sem est, tincidunt at sapien nec, aliquet pellentesque nunc. Cras
                                        scelerisque risus quis rutrum auctor. Phasellus laoreet sapien neque, vel
                                        ullamcorper nunc congue ut. Integer non ipsum sapien Etiam at pellentesque urna.
                                        Nunc sit amet pellentesque neque. Nullam id elementum metus.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabinfo" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first_child">Compositions</td>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td>Girly</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Vivamus vel leo et felis dictum sodales. Duis finibus placerat consectetur. Sed
                                        magna ligula, molestie vitae faucibus sed, consequat ut nisl. Donec at dui
                                        tellus. Nullam sem est, tincidunt at sapien nec, aliquet pellentesque nunc. Cras
                                        scelerisque risus quis rutrum auctor. Phasellus laoreet sapien neque, vel
                                        ullamcorper nunc congue ut. Integer non ipsum sapien Etiam at pellentesque urna.
                                        Nunc sit amet pellentesque neque. Nullam id elementum metus.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="video" role="tabpanel">
                                <div class="text-center product_tab_vidio">
                                    <iframe width="729" height="410"
                                        src="https://www.youtube.com/embed/BUWzX78Ye_8"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products pt-85 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title mb-45">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class=" product_slick slick_slider_activation"
                data-slick='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "arrows": true,
                "dots": false,
                "autoplay": false,
                "speed": 300,
                "infinite": true,
                "responsive":[
                  {"breakpoint":992, "settings": { "slidesToShow": 3 } },
                  {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                  {"breakpoint":480, "settings": { "slidesToShow": 1 } }
                 ]
            }'>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product1.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
                            <div class="product_ratting">
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><span>(4)</span></li>
                                </ul>
                            </div>
                            <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin Shorts</a></h4>
                            <div class="price_box">
                                <span class="current_price">$26.00</span>
                                <span class="old_price">$62.00</span>
                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product2.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                            <div class="product_label">
                                <span>-20%</span>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
                            <div class="product_ratting">
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><span>(6)</span></li>
                                </ul>
                            </div>
                            <h4 class="product_name"><a href="product-gallery-left.html">Make Thing Happen
                                    T-Shirts</a></h4>
                            <div class="price_box">
                                <span class="text-black">$38.00</span>

                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product3.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                            <div class="product_label">
                                <span>-18%</span>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
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
                            <h4 class="product_name"><a href="product-gallery-left.html">Basic White Simple
                                    Sneaker</a></h4>
                            <div class="price_box">
                                <span class="current_price">$43.00</span>
                                <span class="old_price">$46.00</span>
                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product4.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
                            <div class="product_ratting">
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><span>(8)</span></li>
                                </ul>
                            </div>
                            <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded Sunglasses</a>
                            </h4>
                            <div class="price_box">
                                <span class="text-black">$42.00</span>
                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product1.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
                            <div class="product_ratting">
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><span>(12)</span></li>
                                </ul>
                            </div>
                            <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin Shorts</a></h4>
                            <div class="price_box">
                                <span class="current_price">$26.00</span>
                                <span class="old_price">$362.00</span>
                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a href="product-gallery-left.html">
                                <img class="primary_img" src="/assets/img/product/product2.jpg" alt="consectetur">
                            </a>
                            <div class="product_action">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                    <li class="quick_view"><a data-bs-toggle="modal" data-bs-target="#modal_box"
                                            data-tippy="Quick View" href="#" data-tippy-inertia="true"
                                            data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a>
                                    </li>
                                    <li class="compare"><a data-tippy="Compare" href="compare.html"
                                            data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                            data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                </ul>
                            </div>
                            <div class="product_label">
                                <span>-20%</span>
                            </div>
                        </div>
                        <figcaption class="text-center product_content">
                            <div class="product_ratting">
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star"></i></a></li>
                                    <li><span>(14)</span></li>
                                </ul>
                            </div>
                            <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded Sunglasses</a>
                            </h4>
                            <div class="price_box">
                                <span class="current_price">$35.00</span>
                                <span class="old_price">$38.00</span>
                            </div>
                            <div class="add_to_cart">
                                <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                    data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                    data-tippy-placement="top">Add To Cart</a>
                            </div>
                        </figcaption>
                    </figure>
                </article>
            </div>
        </div>
    </section>
    <!--product area end-->




    <div>
        <hr>
        Perú<p>{{ $colores_id }}</p>
    </div>
</div>
