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

    @php
        $rdv = \App\Models\Appointment::where('appointment_column', 'value')->first();
    @endphp

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
        </div>
        <h1 class="text-center mb-5">Calendar</h1>
        <div id='calendar'>
            <p class="text-md"> Prénom : {{$rdv->prenom}}</p>
        </div>
        </div>
@endif

</body>
@endsection
