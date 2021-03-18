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
                        <li><a href="{{ route('home') }}"> ACCUEIL</a></li>
                        <li><a href="#">LOCATIONS</a></li>
                    @endif
                    @if (count(auth()->user()->roles) == 2)
                        <li><a href="#" class="user_id">{{ auth()->user()->firstname }}  {{ auth()->user()->lastname }}</a></li>
                        <li><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li><a href="{{ route('cars@dashboard') }}">VOITURES</a></li>
                        <li><a href="{{ route('car_add') }}">AJOUTER VOITURE</a></li>
                        <li><a href="{{ route('users@dashboard') }}">UTILISATEURS</a></li>
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
            <div class="p-4 copyrightLayout">
                <div class="container-fluid p-3 mt-2">
                    <h6 class="copyright text-white display-6 text-center">COPYRIGHT &copy; <span id="year"></span> BY DEVCRAFT LLC</h6>
                </div>
            </div>
            @auth
                <div class="p-2 copyrightLayout">
                    <div class="container-fluid p-2 mt-1">
                        <h6 class="copyright text-white display-6 text-center">{{ auth()->user()->login }}@CaRRentAL</h6>
                    </div>
                    <div class="container-fluid p-2 mt-1">
                        <form action="{{ route('logout') }}" class="logout text-white text-center" method="POST">
                            @csrf
                            <button type="submit">déconnexion</button>
                        </form>
                    </div>
                </div>
            @endauth
        </footer>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
