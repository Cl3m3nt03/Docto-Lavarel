@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Formulaire</h2>

                        <form class="grid grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <input type="text" name="prenom" placeholder="Prénom" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="text" name="nom" placeholder="Nom" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="email" name="email" placeholder="Email" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="date" name="date" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col col-span-2">
                                <input type="number" name="phone" placeholder="Téléphone" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-2 flex justify-center">
                                <button type="submit"
                                        class="w-full bg-blue-800 text-black font-bold p-3 rounded-lg hover:bg-blue-600 transition">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
