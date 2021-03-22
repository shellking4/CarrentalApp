@extends('layouts.app')

@section('content')
    <div class="flex justify-center my-5">
        <div class="w-5/12 bg-gray-700 p-6 rounded-lg">
            <h5 class="flex form-title justify-center text-center text-white">INSCRIPTION</h5>
        </div>
    </div>
    <div class="flex justify-center mt-0">
        <div class="md:w-5/12 w-10/12 bg-white p-6 rounded-lg">
            <form action="@if(Route::current()->getName() == 'user@register_view') {{ route('user@register_action') }} @else {{ route('admin@register_action') }} @endif" method="post">
                @csrf
                <div class="mb-4">
                    <label for="lastname" class="sr-only">Nom</label>
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Nom" class="bg-white border-2 w-full p-3 rounded-lg @error('lastname') border-red-500 @enderror">
                    @error('lastname')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="firstname" class="sr-only">Prénom</label>
                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="Prénom" class="bg-white border-2 p-3 w-full rounded-lg @error('firstname') border-red-500 @enderror">
                    @error('firstname')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Adresse Email" class="bg-white border-2 p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="login" class="sr-only">Login</label>
                    <input type="text" name="login" id="login" value="{{ old('login') }}" placeholder="Login" class="bg-white border-2 p-3 w-full rounded-lg @error('login') border-red-500 @enderror">
                    @error('login')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="bg-white border-2 w-full p-3 rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Confirmation mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" class="bg-white border-2 p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror">
                    @error('password_confirmation')
                        <p class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-gray-700 text-white px-4 py-3 form-title rounded font-medium w-full">S'INSCRIRE</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
