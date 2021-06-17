<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>EventBike</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="client/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        {{-- <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script> --}}
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="client/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="client/assets/img/event-bike-logo.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#events">Eventos</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li> --}}
                        @if (Route::has('login'))
                        {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> --}}
                            @auth
                                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Principal</a></li>
                            @else
                                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Entrar</a></li>

                                @if (Route::has('register'))
                                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registre-se</a></li>
                                @endif
                            @endauth
                        {{-- </div> --}}
                    @endif

                </ul>

                </div>
                @auth
                    <div class="dropdown-user">
                        <span>{{ Auth::user()->name }}</span>
                        <div class="dropdown-content-user">

                            <img class="user-profile" style="margin-bottom: 2px" src="{{ Auth::user()->adminlte_image() }}" alt="Avatar">
                            <hr>

                            <div style="display: block; margin-top: 2px;">

                                <a class="btn btn-primary btn-sm text-uppercase" href="{{ route('profile') }}">
                                    <i class="fas fa-id-card"> Perfil</i>
                                </a>

                                <a class="btn btn-primary btn-sm text-uppercase" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt">Sair</i>
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Bem vindo ao EventBike!</div>
                <div class="masthead-heading text-uppercase">Sua Plataforma de Eventos de Bike</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Cadastre-se</a>
            </div>
        </header>

        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            @yield('container')
        </section>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="client/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
