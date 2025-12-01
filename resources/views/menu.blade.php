<div class="main_menu d-none d-lg-block">
    <nav class="position-relative">

        <ul class="d-flex">
            <li><a class="active" href="/">Inicio</a> </li>
            <li><a class="active" href="/">Nosotros</a> </li>
            <li class="megamenu-holder"><a href="#">Productos</a>
                <ul class="sub_menu megamenu">

                    @foreach ($categories as $category)
                        <li>
                            <span class="title">{{ $category->name }}</span>
                            <ul>
                                @foreach ($category->subcategories as $subcategory)
                                    <li><a
                                            href="{{ route('product.list.ecommerce', $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach

                </ul>
            </li>
            <li><a class="active" href="index.html">Marcas</a> </li>
            <li><a href="shop.html">Ofertas</a></li>
            <li><a href="#">pages</a>
                <ul class="sub_menu">
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="404.html">Error 404</a></li>
                </ul>
            </li>
            <li><a href="blog.html">blog</a>
                <ul class="sub_menu">
                    <li><a href="blog.html">Blog Pages</a></li>
                    <li><a href="blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Tiendas</a></li>
            <li><a href="contact.html">Contactenos</a></li>
        </ul>

    </nav>
</div>
