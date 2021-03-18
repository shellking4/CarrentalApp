@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-gray-700 p-6 rounded-lg">
            <h5 class="flex form-title text-white justify-center">ADMIN DASHBOARD</h5>
        </div>
    </div>
    <div class="container">
        @if ($cars->count())
            @foreach($cars as $car)
                <div class="row mt-4 mr-md-4 mb-3 py-3">
                    <div class="col-11 col-md-10 offset-md-1">
                        <div class="row ml-4 item bg-dark text-white p-4 rounded-lg">
                            <div class="col-12 col-md-4 p-4">
                                <img src="{{ $car->image }}" alt="car_image" class="rounded">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-12 col-md-4 mt-md-0 mt-4">
                                <h4 class="text-center item-infos text-underline libele uppercase mb-3">Informations</h4>
                                <h5><span class="libele">Modèle</span> : {{ $car->model }}</h5>
                                <h5><span class="libele">Nom en clair</span> : {{ $car->clearName }}</h5>
                                <h5><span class="libele">Description</span> : {{ $car->description }}</h5>
                                <h5><span class="libele">Nombre de places</span> : {{ $car->nbPlaces }}</h5>
                                <h5><span class="libele">Prix</span> : {{ $car->price }} FCFA</h5>
                                <h5><span class="libele">Louée ou Empruntée</span> : @if ($car->isRented == true)
                                    Oui
                                @else
                                    Non
                                @endif</h5>
                            </div>
                            <form action="{{ route('car_delete', $car) }}" method="post" class="btn col-md-5 col-12">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn mt-4 btn-danger">SUPPRIMER</button>
                            </form>
                            <div class="col-md-2"></div>
                            <form action="{{ route('car_update_view', $car) }}" method="get" class="btn col-md-5 col-12">
                                @csrf
                                <button type="submit" class="btn mt-4 btn-info">MODIFIER</button>
                            </form>
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
@endsection
