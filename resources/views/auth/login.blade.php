@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-1">
        <div class="md:w-5/12 w-10/12 bg-white p-6 mt-5 rounded-lg">
            @if (session()->has('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf
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
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="mt-2">Se souvenir de moi</label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="theme-ground text-white px-4 py-3 mt-5 rounded form-title font-medium w-full">SE CONNECTER</button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-center my-3">
        <div class="w-5/12 p-6 rounded-lg">
            <form action="{{ route('user@register_view') }}" class="flex justify-center text-center" method="get">
                @csrf
                <button type="submit" class="text-blue-800">Pas de compte ? Créez-en un</button>
            </form>
        </div>
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
