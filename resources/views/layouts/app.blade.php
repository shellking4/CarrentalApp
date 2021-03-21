<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CaRRentAL</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}" />
        <link rel="icon" href="{{ asset('images/theater-masks.png') }}" />
    </head>
    <body class="bg-gray-400">
        <nav>
            <div>
                <h4 class="logo">CARRENTAL</h4>
            </div>
            <ul class="nav-links" id="app-nav">
                @auth
                    @if (count(auth()->user()->roles) == 1)
                        <li><a href="#" class="user_id">{{ auth()->user()->firstname }}  {{ auth()->user()->lastname }}</a></li>
                        <li><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li><a href="{{ route('auth.user_rents') }}">LOCATIONS</a></li>
                        <li><a href="{{ route('auth.user_free_rents') }}">EMPRUNTS</a></li>
                    @endif
                    @if (count(auth()->user()->roles) == 2)
                        <li class="account">
                            <button class="user_id">{{ auth()->user()->firstname }}  {{ auth()->user()->lastname }}</button>
                            <ul>
                                <li><a href="{{ route('auth.user_rents') }}">LOCATIONS</a></li>
                                <li><a href="{{ route('auth.user_free_rents') }}">EMPRUNTS</a></li>
                            </ul>
                        </li>
                        <li class="users">
                            <button>UTILISATEURS</button>
                            <ul>
                                <li><a href="">TOUS</a></li>
                                <li><a href="">AYANTS EMPRUNTÉ</a></li>
                                <li><a href="">AYANTS LOUÉ</a></li>
                            </ul>
                        </li>
                        <li class="cars">
                            <button>VOITURES</button>
                            <ul>  
                                <li><a href="{{ route('cars@dashboard') }}">VOITURES</a></li>
                                <li><a href="{{ route('car_add') }}">AJOUTER VOITURE</a></li>
                            </ul>
                        <li>
                        <li><a href="{{ route('home') }}">ACCUEIL</a></li>                        
                    @endif
                @endauth
                @guest
                    <li><a href="{{ route('home') }}">ACCUEIL</a></li>
                    <li><a href="{{ route('login') }}">CONNEXION</a></li>
                    <li><a href="{{ route('user@register_view') }}">INSCRIPTION</a></li>
                @endguest
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
            @guest
                <div class="p-4 copyrightLayout">
                    <div class="container-fluid p-2 mt-2">
                        <h6 class="copyright text-white display-6 text-center">COPYRIGHT &copy; <span id="year"></span> BY DEVCRAFT LLC</h6>
                    </div>
                </div>
                <div class="py-0 copyrightLayout bg-dark">
                    <div class="container-fluid ">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <form action="{{ route('carrental.policies') }}" class="logout text-white text-center" method="get">
                                            @csrf
                                            <button type="submit">Politiques et Confidentialités</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest
            @auth
            <div class="py-4 copyrightLayout">
                <div class="container-fluid p-2 mt-2">
                    <h6 class="copyright text-white display-6 text-center">COPYRIGHT &copy; <span id="year"></span> BY DEVCRAFT LLC</h6>
                </div>
            </div>
            <div class="p-1 copyrightLayout">
                <div class="container-fluid p-2 mt-1">
                    <h6 class="copyright text-white display-6 text-center">{{ auth()->user()->login }}@CaRRentAL</h6>
                </div>
            </div>
            <div class="py-0 copyrightLayout bg-dark">
                <div class="container-fluid ">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('carrental.policies') }}" class="logout text-white text-center" method="get">
                                        @csrf
                                        <button type="submit">Politiques et Confidentialités</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('logout') }}" class="logout text-white text-center" method="POST">
                                        @csrf
                                        <button type="submit">Déconnexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
            <button onClick="topFunction()" id="myBtn" title="Haut de Page"><span class="fas fa-chevron-circle-up fa-2x"></span></button>
        </footer>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
