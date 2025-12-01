<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- str_replace('_', '-', app()->getLocale()): Esta función de PHP reemplaza cualquier guion bajo (_) en el código de idioma con un guion (-).
Esto es porque los códigos de idioma en HTML suelen usar guiones (por ejemplo, en-US en lugar de en_US). --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TICOM SOFTWARE') }}  </title>
    {{-- 'config('app.name', 'Laravel'): Esta función de Laravel obtiene el valor de configuración de la clave app.name del archivo de configuración config/app.php.
    Si no se encuentra esta clave, se usa el valor por defecto 'Laravel'. --}}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">



    @stack('styles')

    @livewireStyles

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->

        @if (session()->has('flash'))
            <div class="flex items-center px-4 py-3 text-sm font-bold text-white bg-blue-500" role="alert">
                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('flash') }}</p>
            </div>
        @endif


        <main>
            {{ $slot }}
        </main>


        @if (isset($footer))
            <div class="mt-4 bg-white shadow">
                {{ $footer }}
            </div>
        @endif


    </div>

    @stack('modals')


    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



    @livewireScripts



    @stack('scripts')



    <script>
        livewire.on('alert', function(message) {
            Swal.fire(
                'TICOM SRL!',
                message,
                'SOFTWARE EMPRESARIAL'
            )
        })
    </script>


       {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
       <script src="{{ mix('js/app.js') }}"></script>

        @auth
            <script>
                Echo.private('App.Models.User.' + {{ Auth::user()->id }})
                    .notification((notification) => {
                        //console.log(notification.type);
                        //Livewire.emit('cantidad');
                        Livewire.emitTo('admin.notification-shipment', 'cantidad');
                    });
            </script>
        @endauth

</body>

</html>
