@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>


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
        <div id='calendar'>


            <button class="button is-warning py-1 px-2 mx-5 my-3 hover:cursor-pointer">supprimer</button>
            <h2 class="my-6 py-5 text-center text-2xl font-bold text-gray-800">Liste des rendez-vous</h2>

            <div class="overflow-x-auto p-5">
                <table class="min-w-full border-collapse border border-gray-300 shadow-lg bg-white rounded-lg">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nom du Patient</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Prénom du Patient</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Téléphone</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date du rendez-vous</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($schedules->isNotEmpty())
                    @foreach ($schedules as $schedule)
                        <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->nom }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->prenom }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->date }}</td>
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

