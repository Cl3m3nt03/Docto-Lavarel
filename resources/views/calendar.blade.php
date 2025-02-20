@extends('layouts.app')

@section('content')
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/fr.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="{{asset('img/favicon.jpg')}}" type="image/x-icon">

    <script src="{{ asset('js/calendar.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">

    <body class="antialiased bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex flex-col items-center justify-center text-white">
    @if (Route::has('login'))
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
    @endif

    <h1 class="text-center text-4xl font-bold my-8 text-black">Calendar</h1>
    <div id='calendar' class="text-black mx-auto rounded-lg shadow-lg p-5 w-full h-75 w-50"></div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let calendarEl = document.getElementById('calendar');

                        let calendar = new FullCalendar.Calendar(calendarEl, {
                            locale: 'fr', // Langue française
                            initialView: 'dayGridMonth', // Vue par défaut : grille mensuelle
                            editable: false, // Empêcher la modification des événements
                            selectable: false, // Empêcher la sélection des dates

                            events: '/events', // Récupérer les événements depuis l'API Laravel

                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },


                            // Assurez-vous que les événements s'affichent correctement
                            eventRender: function(info) {
                                console.log(info.event); // Affiche les événements dans la console pour débogage
                            }
                        });

                        calendar.render(); // Initialiser et afficher le calendrier
                    });
                </script>

                <h2 class=" mt-5 text-black text-xxl font-bold text-center mb-5">Liste des rendez-vous</h2>
        <div class="overflow-x-auto">
            <table class="text-center text-black mx-auto align-items-center min-w-max border-collapse border border-gray-300 shadow-lg bg-white rounded-4xl    ">
                <thead class="bg-gray-200">
                @if($appointments->isNotEmpty())
                    @foreach($appointments as $appointment)
                        <tr>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Nom du patient</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Prénom du patient</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Email</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Téléphone</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Date du rendez-vous</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Supprimer un rendez-vous</th>
                            <th class="border-2 border-gray-300 px-4 py-3 text-left text-bg-light">Ajouter un rendez-vous</th>
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
    @endsection
</body>
