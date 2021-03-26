@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-8/12 theme-ground p-6 rounded-lg">
            <h5 class="flex form-title text-white text-center justify-center">VOITURES DISPONIBLES DANS LE PARC</h5>
        </div>
    </div>
    <div class="container">
        @if (session()->has('pass_reset_success'))
            <p class="pass-reset-success"></p>
            {{ Session::forget('pass_reset_success') }}
        @endif
        @if ($cars->count())
            @foreach($cars as $car)
                <div class="row mt-4 mr-md-4 mb-3 py-3">
                    <div class="col-11 col-md-10 offset-md-1">
                        <div class="row ml-4 item bg-dark text-white p-4 rounded-lg">
                            <div class="col-12 col-md-6 p-4">
                                <img src="{{ $car->image }}" alt="car_image" class="rounded">
                            </div>
                            <div class="col-12 col-md-6 mt-md-0 mt-4 px-3">
                                <h4 class="text-center item-infos text-underline libele uppercase mb-3 mt-4">Informations</h4>
                                <h5><span class="libele">Modèle</span> : {{ $car->model }}</h5>
                                <h5><span class="libele">Nom en clair</span> : {{ $car->clearName }}</h5>
                                <h5><span class="libele">Description</span> : {{ $car->description }}</h5>
                                <h5><span class="libele">Nombre de places</span> : {{ $car->nbPlaces }}</h5>
                                <h5><span class="libele">Prix Location/Jour</span> : {{ $car->price }} FCFA</h5>
                                <h5><span class="libele">Louée ou Empruntée</span> : @if ($car->isRented == true)
                                    Oui
                                @else
                                    Non
                                @endif</h5>
                            </div>
                            @guest
                                <form action="{{ route('login') }}" method="get" class="btn col-md-12 col-12">
                                    @csrf
                                    <button type="submit" class="btn mt-4 btn-info">SE CONNECTER POUR LOUER OU EMPRUNTER CETTE VOITURE</button>
                                </form>
                            @endguest
                            @auth
                                <form action="{{ route('rent_perform_view', $car) }}" method="get" class="btn mt-md-4 col-md-5 col-12">
                                    @csrf
                                    <button type="submit" class="btn mt-4 btn-success px-4">LOUER</button>
                                </form>
                                <div class="col-md-2"></div>
                                <form action="{{ route('free_rent_perform_view', $car) }}" method="get" class="btn mt-md-4 col-md-5 col-12">
                                    @csrf
                                    <button type="submit" class="btn mt-4 btn-warning px-2">EMPRUNTER</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container-fluid mt-4">
                <p class="text-center mt-4">AUCUNE VOITURE DANS LE PARC ACTUELLEMENT</p>
            </div>
        @endif
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
