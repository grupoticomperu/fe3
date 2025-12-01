<div>
    <div class="navbar-section">
        <div class="techvio-responsive-nav">
            <div class="container">
                <div class="techvio-responsive-menu">
                    <div class="logo">
                        <a href="index.html">
                            <img src="assets/img/logo.png" class="white-logo" alt="logo">
                            <img src="assets/img/logo-black.png" class="black-logo" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="techvio-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/img/logo.png" class="white-logo" alt="logo">
                        <img src="assets/img/logo-black.png" class="black-logo" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            {{-- <li class="nav-item">
                                <a href="about.html" class="nav-link">Inicio </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="about.html" class="nav-link">Nosotros </a>
                            </li>
                            <li class="nav-item">
                                <a href="about.html" class="nav-link">Facturación Electrónica </a>
                            </li>

                            <li class="nav-item">
                                <a href="about.html" class="nav-link">Blog </a>
                            </li>



                            <li class="nav-item">
                                <a href="contact.html" class="nav-link">Contáctenos</a>
                            </li>


                            @guest
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link" style="color: gray;">Ingresar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link" style="color: gray;">Registrarte</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{ route('admin.showtables') }}" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: gray;">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown"
                                        aria-labelledby="userDropdown" style="background-color: white;">
                                        <a class="pl-1 dropdown-item custom-dropdown-item"
                                            href="{{ route('admin.showtables') }}" style="color: black;"> <i
                                                class="fas fa-chevron-right"></i> Ir al Sistema</a>
                                        <a class="pl-1 dropdown-item custom-dropdown-item"
                                            href="{{ route('profile.show') }}" style="color: black;"><i
                                            class="fas fa-chevron-right"></i> Ver Perfil</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="pl-1 dropdown-item custom-dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                style="color: black;"><i
                                                class="fas fa-chevron-right"></i> Cerrar Sesión</a>
                                        </form>
                                    </div>
                                </li>
                            @endguest



                        </ul>



                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
