@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-1">
        <div class="md:w-5/12 w-10/12 bg-white p-6 mt-5 rounded-lg">
            <form action="{{ route('pass.reset.action') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" class="bg-white border-2 w-full p-3 rounded-lg @error('password') border-red-500 @enderror">
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
                    <button type="submit" class="theme-ground text-white px-4 py-3 form-title rounded font-medium w-full">VALIDER LA MODIFICATION</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
