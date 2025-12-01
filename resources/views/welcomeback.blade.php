<x-appweb-layout>
    <x-slot name="menu">
       {{--  @include('menu') --}}
    </x-slot>

    <!--slider area start-->
    <section class="slider_section">
        <div class="slider_area slick_slider_activation"
            data-slick='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "arrows": true,
            "dots": true,
            "autoplay": true,
            "speed": 300,
            "infinite": true
        }'>
            <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="slider_text">
                                <span>Lookbook</span>
                                <h1>fashion trend for autum girls with vibes</h1>
                                <p>We love seeing how our Edon wearers like <br> to wear their Norda</p>
                                <a class="btn btn-primary" href="shop.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="text-white slider_text">
                                <span>Handbag</span>
                                <h1>Men Collection Preview</h1>
                                <p class="text-white">The collection grows each year with original stories and design
                                    features by Edon's employees.</p>
                                <a class="btn btn-primary" href="shop.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--slider area end-->


    <!-- banner section start -->
    <section class="pt-2 banner_section banner_style2">
        <div class="p-0 overflow-hidden container-fluid">
            <div class="row g-0">
                <div class="mb-2 col-lg-6 col-md-6 pe-2 mb-md-0">
                    <figure class="single_banner position-relative h-100">
                        <img class="img-full" src="assets/img/bg/bg1.jpg" alt="">
                        <div class="banner_text position-absolute">
                            <h3>Minimalist <br> sneaker</h3>
                            <p>Stretch, fresh-cool help you alway <br> comfortable</p>
                            <a class="btn btn-primary" href="shop.html">Shop Now</a>
                        </div>
                        <div class="banner_tag">
                            <span>new arrivals <br> men</span>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure class="single_banner position-relative">
                        <img class="img-full" src="assets/img/bg/bg2.jpg" alt="">
                        <div class="banner_text position-absolute text__style2">
                            <h3><span>50%</span> OFF <br> for Autumn</h3>
                            <p>Shoes Will Make You Tons Of Cash. <br> Here's How!</p>
                            <a class="btn btn-primary" href="shop.html">Shop Now</a>
                        </div>
                        <div class="banner_tag">
                            <span>mega sale</span>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->


    <!-- product section start -->
    <section class="product_section pt-95">
        <div class="container">
            <div class="product_header d-flex justify-content-between mb-45">
                <div class="section_title">
                    <h2>best selling items</h2>
                </div>

                <div class="product_tab_btn d-flex">
                    <ul class="nav" id="myTab" role="tablist">
                        <li>
                            <a class="active" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all"
                                aria-selected="true">All</a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#clothings" role="tab" aria-controls="clothings"
                                aria-selected="false">Clothings</a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#bags" role="tab" aria-controls="bags"
                                aria-selected="false">Bags</a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#shoes" role="tab" aria-controls="shoes"
                                aria-selected="false">Shoes</a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#accessories" role="tab" aria-controls="accessories"
                                aria-selected="false">Accessories</a>
                        </li>
                    </ul>
                    <div class="all_product">
                        <a href="shop.html">All Product</a>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="all" role="tabpanel">
                        <div class="product_slick slick_slider_activation"
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
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>

                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$62.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary btn-axolotl" href="#"
                                                data-tippy="Add To Cart" data-tippy-inertia="true"
                                                data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product3.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic White
                                                Simple Sneaker</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product4.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$42.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$38.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="clothings" role="tabpanel">
                        <div class="product_slick slick_slider_activation"
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
                                            <img class="primary_img" src="assets/img/product/product3.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic White
                                                Simple Sneaker</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product4.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$42.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$38.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$62.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a title="Add To Cart" class="btn btn-primary" href="#">Add To
                                                Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="bags" role="tabpanel">
                        <div class="product_slick slick_slider_activation"
                            data-slick='{
                         "slidesToShow": 4,
                         "slidesToScroll": 1,
                         "arrows": true,
                         "dots": false,
                         "autoplay": false,
                         "speed": 300,
                         "infinite": true ,
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
                                            <img class="primary_img" src="assets/img/product/product3.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic White
                                                Simple Sneaker</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product4.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$42.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$62.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a title="Add To Cart" class="btn btn-primary" href="#">Add To
                                                Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Make Thing
                                                Happen T-Shirts</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$38.00</span>

                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$38.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shoes" role="tabpanel">
                        <div class="product_slick slick_slider_activation"
                            data-slick='{
                         "slidesToShow": 4,
                         "slidesToScroll": 1,
                         "arrows": true,
                         "dots": false,
                         "autoplay": false,
                         "speed": 300,
                         "infinite": true ,
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
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Make Thing
                                                Happen T-Shirts</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$38.00</span>

                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$38.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product3.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic White
                                                Simple Sneaker</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product4.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$42.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$62.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a title="Add To Cart" class="btn btn-primary" href="#">Add To
                                                Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="accessories" role="tabpanel">
                        <div class="product_slick slick_slider_activation"
                            data-slick='{
                         "slidesToShow": 4,
                         "slidesToScroll": 1,
                         "arrows": true,
                         "dots": false,
                         "autoplay": false,
                         "speed": 300,
                         "infinite": true ,
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
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$62.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a title="Add To Cart" class="btn btn-primary" href="#">Add To
                                                Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Make Thing
                                                Happen T-Shirts</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$38.00</span>

                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product1.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic Joggin
                                                Shorts</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product2.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$38.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product3.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Basic White
                                                Simple Sneaker</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">$43.00</span>
                                            <span class="old_price">$46.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a href="product-gallery-left.html">
                                            <img class="primary_img" src="assets/img/product/product4.jpg"
                                                alt="consectetur">
                                        </a>
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="wishlist.html" data-tippy="Wishlist"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-bs-toggle="modal"
                                                        data-bs-target="#modal_box" data-tippy="Quick View"
                                                        href="#" data-tippy-inertia="true"
                                                        data-tippy-delay="50" data-tippy-arrow="true"
                                                        data-tippy-placement="left"><i
                                                            class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="compare.html"
                                                        data-tippy-inertia="true" data-tippy-delay="50"
                                                        data-tippy-arrow="true" data-tippy-placement="left"><i
                                                            class="icon-refresh icons"></i></a></li>
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
                                        <h4 class="product_name"><a href="product-gallery-left.html">Simple Rounded
                                                Sunglasses</a></h4>
                                        <div class="price_box">
                                            <span class="text-black">$42.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="#" data-tippy="Add To Cart"
                                                data-tippy-inertia="true" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product section end -->

    <!-- banner section start -->
    <section class="banner_section pt-75 pb-100">
        <div class="container">
            <div class="section_title mb-45">
                <h2>featured collections</h2>
            </div>
            <div class="banner_container d-flex">
                <figure class="single_banner position-relative me-xs-30 mb-xs-30">
                    <img src="assets/img/bg/bg3.jpg" alt="">
                    <figcaption class="banner_text position-absolute">
                        <h3>Zara Pattern <br> backpacks</h3>
                        <p>Learn How To Make More Money <br> With Cloth.</p>
                        <a class="btn btn-primary" href="shop.html">Shop Now</a>
                    </figcaption>
                </figure>
                <figure class="single_banner position-relative">
                    <img src="assets/img/bg/bg4.jpg" alt="">
                    <figcaption class="banner_text position-absolute">
                        <h3>Basic Color Caps</h3>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- blog section start -->
    <section class="blog_section bg-white-smoke pt-95 py-95">
        <div class="container">
            <div class="blog_header d-flex justify-content-between">
                <div class="section_title mb-45">
                    <h2>press & look</h2>
                </div>
                <div class="all_articles">
                    <a href="blog.html">All articles</a>
                </div>
            </div>
            <div class="blog_slick slick_slider_activation"
                data-slick='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "arrows": false,
                "dots": false,
                "autoplay": false,
                "speed": 300,
                "infinite": true,
                "responsive":[
                  {"breakpoint":992, "settings": { "slidesToShow": 2 } },
                  {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                  {"breakpoint":576, "settings": { "slidesToShow": 1 } }
                ]
            }'>
                <article class="single_blog">
                    <figure>
                        <div class="blog_thumb">
                            <a href="blog.html"><img src="assets/img/blog/blog1.jpg" alt=""></a>
                        </div>
                        <figcaption class="blog_content">
                            <div class="blog_meta">
                                <ul class="d-flex">
                                    <li><span class="meta_tag">News</span></li>
                                    <li><span>May 25, 2021</span></li>
                                </ul>
                            </div>
                            <h3><a href="blog-details.html">Five things you only know if you’re at Chanel's Hamburg
                                    Show</a></h3>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_blog">
                    <figure>
                        <div class="blog_thumb">
                            <a href="blog.html"><img src="assets/img/blog/blog2.jpg" alt=""></a>
                        </div>
                        <figcaption class="blog_content">
                            <div class="blog_meta">
                                <ul class="d-flex">
                                    <li><span class="meta_tag">News</span></li>
                                    <li><span>May 20, 2021</span></li>
                                </ul>
                            </div>
                            <h3><a href="blog-details.html">Calvin Klein Shoes Collection 2021, Activites Summer</a>
                            </h3>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_blog">
                    <figure>
                        <div class="blog_thumb">
                            <a href="blog.html"><img src="assets/img/blog/blog3.jpg" alt=""></a>
                        </div>
                        <figcaption class="blog_content">
                            <div class="blog_meta">
                                <ul class="d-flex">
                                    <li><span class="meta_tag">News</span></li>
                                    <li><span>May 15, 2021</span></li>
                                </ul>
                            </div>
                            <h3><a href="blog-details.html">Rem nam explicabo dolorum tenetur tempore labore</a></h3>
                        </figcaption>
                    </figure>
                </article>
                <article class="single_blog">
                    <figure>
                        <div class="blog_thumb">
                            <a href="blog.html"><img src="assets/img/blog/blog1.jpg" alt=""></a>
                        </div>
                        <figcaption class="blog_content">
                            <div class="blog_meta">
                                <ul class="d-flex">
                                    <li><span class="meta_tag">News</span></li>
                                    <li><span>May 01, 2021</span></li>
                                </ul>
                            </div>
                            <h3><a href="blog-details.html">Five things you only know if you’re at Chanel's Hamburg
                                    Show</a></h3>
                        </figcaption>
                    </figure>
                </article>
            </div>
        </div>
    </section>
    <!-- blog section end -->

    <!--shipping section start-->
    <section class="shipping_section bg-white-smoke">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shipping_inner d-flex justify-content-between py-95">
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-cursor icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Free Shipping</h3>
                                <p>Orders over $100</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-reload icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Free Returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-lock icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>100% Payment Secure</h3>
                                <p>Payment Online</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-tag icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Affordable Price</h3>
                                <p>Guaranteed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--shipping section end-->

    <!-- instagram section start -->
    <div class="instagram_section pb-95">
        <div class="p-0 overflow-hidden container-fluid">
            <div class="row g-0">
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/1.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/2.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/3.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/4.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/5.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/6.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/7.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
                <div class="instagram-custom-col">
                    <div class="instagram-item">
                        <a class="instagram-img" href="#">
                            <img src="assets/img/instagram/8.jpg" alt="Instagram Image">
                        </a>
                        <a href="#" class="instagram-add-action"><i class="ion-ios-plus-empty"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- instagram section end -->






    <div class="container py-8">

    </div>

    @push('script')
        <script>
            Livewire.on('glider', function(id) {

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [{
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },

                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },

                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });

            });
        </script>
    @endpush

</x-appweb-layout>
