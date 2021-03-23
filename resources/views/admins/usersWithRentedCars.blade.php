@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h5 class="flex justify-center">UTILISATEURS AYANT LOUÉ DE VOITURES</h5>
        </div>
    </div>
    <div class="container-fluid">
        @if (count($users))
            <div class="table-responsive mt-4" width="150" height="">
                <table class="table table-bordered table-sm offset-lg-2 table-hover">
                    <thead class="thead-info">
                        <tr>
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col" class="text-center">Nom</th>
                            <th scope="col" class="text-center">Prénom</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Login</th>
                            <th scope="col" class="text-center">Locations</th>
                            <th scope="col" class="text-center">Montant total des locations</th>
                            <th scope="col" class="text-center">Opérations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-center">{{ $user->lastname }}</td>
                                <td class="text-center">{{ $user->firstname }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->login }}</td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{ route('user_rents', $user) }}" method="get">
                                                @csrf
                                                <button title="Les locations de voitures de l'utilisateur" type="submit"><span class="text-success mt-md-2 mt-4 fas fa-car"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $user->owedRentAmount }} FCFA</td>
                                <td class="text-center px-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('user_update_view', $user) }}" method="get" class="">
                                                @csrf
                                                <button title="Modifier des informations de l'utilisateur" type="submit"><span class="text-success mt-md-2 mt-4 fas fa-edit"></span></button>
                                            </form>

                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('user_delete', $user) }}" method="post" class="">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Supprimer l'utilisateur de la plateforme" type="submit"><span class="fas fa-trash mt-4 mt-md-2 text-danger"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="container-fluid mt-4 on_empty_message">
                <p class="text-center mt-4">PAS D'UTILISATEURS AYANT LOUÉ DE VOITURES</p>
            </div>
        @endif
    </div>
    <div class="py-12"></div>
    <div class="py-12"></div>
    <div class="py-12"></div>
@endsection
