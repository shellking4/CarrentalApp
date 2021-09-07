@extends('layouts.app')

@section('content')
    <div class="flex justify-center my-5">
        <div class="w-5/12 theme-ground p-6 rounded-lg">
            <h5 class="flex form-title justify-center text-center text-white">DÉTAILS DE L'EMPRUNT</h5>
        </div>
    </div>
    <div class="flex justify-center mt-1">
        <div class="md:w-5/12 w-10/12 bg-white p-6 mt-5 rounded-lg">
            <form action="{{ route('free_rent.proceed', $car) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="rentTime" class="sr-only">Temps de Location(Nombre de jours)</label>
                    <input type="number" name="rentTime" id="rentTime" value="{{ old('rentTime') }}" placeholder="Durée de location (en jours)" class="bg-white border-2 p-3 w-full rounded-lg @error('rentTime') border-red-500 @enderror">
                    @error('rentTime')
                        <p id="error_message" class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="theme-ground text-center text-white px-4 py-3 mt-5 rounded form-title font-medium w-full">PROCÉDER À L'EMPRUNT</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
