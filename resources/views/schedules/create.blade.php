@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        @can('create', App\Models\Schedule::class)
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">🕒 Ajouter un créneau horaire</h2>

            {{-- ✅ Gestion des erreurs --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong>Erreur(s) :</strong>
                    <ul class="list-disc pl-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 📅 Formulaire --}}
            <form action="{{ route('schedules.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">📆 Date :</label>
                    <input type="date" id="date" name="date" required
                           class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">⏰ Heure de début :</label>
                    <input type="time" id="start_time" name="start_time" required
                           class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">⏳ Heure de fin :</label>
                    <input type="time" id="end_time" name="end_time" required
                           class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white text-lg font-semibold p-3 rounded-lg hover:bg-blue-500 transition-all shadow-md">
                    ➕ Ajouter le créneau
                </button>
            </form>
        @else
            <p class="text-red-500 text-center text-xl mt-6">
                🚫 Vous n'avez pas accès à cette page.
            </p>
        @endcan
    </div>
@endsection
