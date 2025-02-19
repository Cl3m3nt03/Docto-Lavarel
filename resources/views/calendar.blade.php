@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">

    <body class="antialiased">

<div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-screen flex items-center justify-center">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/calendar') }}" class="text-2xl font-bold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Calendar</a>
                <a href="{{ url('/home') }}" class="text-2xl font-bold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-2xl font-bold text-white hover:text-gray-400 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-black-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-2xl ml-4 font-bold text-white hover:text-gray-400 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-black-500">Register</a>
                @endif
            @endauth
                @endif
        </div>
        <h1 class="text-center mb-5">Calendar</h1>
        <div id='calendar' class="mx-auto h-75 w-50" > </div>
        <div class="overflow-x-auto p-5">
            <h2 class="my-6 py-5 text-center text-2xl font-bold text-gray-800">Liste des rendez-vous</h2>
            <div class="overflow-x-auto">
                <table class="mx-auto align-items-center min-w-max border-collapse border border-gray-300 shadow-lg bg-white rounded-4xl    ">
                    <thead class="bg-gray-200 ">
                    @if($appointments->isNotEmpty())
                    @foreach($appointments as $appointment)
                    <tr>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Nom du patient</th>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Prénom du patient</th>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Email</th>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Téléphone</th>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Date du rendez-vous</th>
                        <th class="border-2 border-gray-300 px-4 py-3 text-left">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-300 transition">
                        <td class="border border-gray-300 px-4 py-3">{{ $appointment->nom }}</td>
                        <td class="border border-gray-300 px-4 py-3">{{ $appointment->prenom }}</td>
                        <td class="border border-gray-300 px-4 py-3">{{ $appointment->email }}</td>
                        <td class="border border-gray-300 px-4 py-3">{{ $appointment->telephone }}</td>
                        <td class="border border-gray-300 px-4 py-3">{{ $appointment->date }}</td>
                        <td class="border border-gray-300 px-4 py-3">
                            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('vous êtes sur le point de supprimer votre rendez-vous, voulez vous vraiment continuer ?')">
                                @csrf
                                @method('DELETE')
                                <button class="odd:bg-red">Annuler</button>
                            </form>

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
        </div>
@endsection
</body>

