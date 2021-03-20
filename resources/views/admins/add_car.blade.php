@extends('layouts.app')

@section('content')
    <div class="flex justify-center my-5">
        <div class="w-5/12 bg-gray-700 p-6 rounded-lg">
            <h5 class="flex justify-center form-title text-center text-white">AJOUT VOITURE</h5>
        </div>
    </div>
    <div class="flex justify-center mt-5">
        <div class="md:w-5/12 w-10/12 bg-white p-6 rounded-lg">
            <form action="{{ route('car_add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="model" class="sr-only">Modèle Voiture</label>
                    <input type="text" name="model" id="model" value="{{ old('model') }}" placeholder="Modèle" class="bg-white border-2 w-full p-3 rounded-lg @error('model') border-red-500 @enderror">
                    @error('model')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="clearname" class="sr-only">Appelation en claire</label>
                    <input type="text" name="clearname" id="clearname" value="{{ old('clearname') }}" placeholder="Nom courant" class="bg-white border-2 p-3 w-full rounded-lg @error('clearname') border-red-500 @enderror">
                    @error('clearname')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="sr-only">Description</label>
                    <input type="description" name="description" id="description" value="{{ old('description') }}" placeholder="Description" class="bg-white border-2 p-3 w-full rounded-lg @error('description') border-red-500 @enderror">
                    @error('description')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="nbplaces" class="sr-only">Nombre de places</label>
                    <input type="number" name="nbplaces" id="nbplaces" value="{{ old('nbplaces') }}" placeholder="Nombre de places" class="bg-white border-2 p-3 w-full rounded-lg @error('nbplaces') border-red-500 @enderror">
                    @error('nbplaces')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="price" class="sr-only">Prix location</label>
                    <input type="text" name="price" id="price" placeholder="Prix Location" value="{{ old('price') }}" class="bg-white border-2 w-full p-3 rounded-lg @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="w-full flex flex-col items-center bg-white text-blue rounded-lg uppercase border cursor-pointer hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-1 text-base leading-normal text-center">Choisissez une image</span>
                        <input type='file' name="car_image" id="car_image" value="{{ old('car_image') }}" class="hidden" />
                    </label>
                    @error('car_image')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-700 text-white form-title px-4 py-3 rounded font-medium w-full">AJOUTER</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
