@extends('layouts.app')

@section('content')
    <p class="freeRentSuccessMessage">{{ count($freeRents) }}</p>
    @if ($value->actual)
        
    @endif
    <div class="flex justify-center mt-5">
        <div class="w-8/12 theme-ground p-6 rounded-lg">
            <h5 class="flex form-title text-white  text-center justify-center uppercase">MES EMPRUNTS DE VOITURES</h5>
        </div>
    </div>
    <div class="container">
        @if (count($freeRents))
            @foreach($freeRents as $car)
                <div class="duration">
                    <h6 class="duration">{{ array_search($car, $freeRents) }}</h6>
                    <p class="endOfRent">{{ $car->endOfRentDate }}</p>
                </div>
                <div class="row mt-4 mr-md-4 mb-3 py-3">
                    <div class="col-11 col-md-10 offset-md-1">
                        <div class="row ml-4 item bg-dark text-white p-4 rounded-lg">
                            <div class="col-12 col-md-6 p-4">
                                <img src="{{ $car->image }}" alt="car_image" class="rounded">
                            </div>
                            <div class="col-12 col-md-6 mt-md-0 mt-4">
                                <h4 class="text-center item-infos text-underline libele uppercase mt-4 mb-3">Informations</h4>
                                <h5><span class="libele">Modèle</span> : {{ $car->model }}</h5>
                                <h5><span class="libele">Nom en clair</span> : {{ $car->clearName }}</h5>
                                <h5><span class="libele">Description</span> : {{ $car->description }}</h5>
                                <h5><span class="libele">Nombre de places</span> : {{ $car->nbPlaces }}</h5>
                                <h5><span class="libele">Prix</span> : {{ $car->price }} FCFA</h5>
                                <h5><span class="libele">Nombre de jours d'usage</span> : {{ $car->locationDaysNumber }} Jours</h5>
                            </div>
                            <div class="col-md-12 mt-3">
                                <h5 class="text-center my-4">TEMPS D'USAGE RESTANT</h5>
                                <div id="timer-{{ array_search($car, $freeRents) }}" class="flex-wrap timer d-flex justify-content-center">
                                    <div class="days" class="align-items-center flex-column d-flex justify-content-center"></div>
                                    <div class="hours" class="align-items-center flex-column d-flex justify-content-center"></div>
                                    <div class="minutes" class="align-items-center flex-column d-flex justify-content-center"></div>
                                    <div class="seconds" class="align-items-center flex-column d-flex justify-content-center"></div>
                                </div>
                            </div>
                            <form action="{{ route('free_rented_car_send_back', $car) }}" method="post" class="btn col-md-12 col-12">
                                @csrf
                                <button type="submit" class="btn mt-4 btn-ground px-2">RENDRE CETTE VOITURE</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container-fluid mt-4">
                <p class="text-center mt-4 uppercase">AUCUNE VOITURE EMPRUNTÉE</p>
            </div>
        @endif
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
