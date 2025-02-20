<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getAllEvents(): JsonResponse
    {
        // Récupérer tous les événements depuis la base de données
        $events = Appointment::all();

        // Transformer les données pour correspondre au format attendu par FullCalendar
        $formattedEvents = $events->map(function ($event) {
            return [
                'id'    => $event->id,
                'name'  => $event->prenom . ' ' . $event->nom,
                'title' => $event->nom,
                'start' => $event->date . 'T' . $event->heure, // Correction ici : utilisation de `heure`
            ];
        });

        return response()->json($formattedEvents);
    }

    public function index(): JsonResponse
    {
        return response()->json(Appointment::all());
    }

    public function store(Request $request): JsonResponse
    {
        // Validation des données entrantes
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom'    => 'required|string|max:255',
            'date'   => 'required|date',
            'heure'  => 'required|date_format:H:i',
        ]);

        // Création d'un nouvel événement
        $event = Appointment::create($validated);

        return response()->json($event, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        // Trouver l'événement ou renvoyer une erreur
        $event = Appointment::findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'prenom' => 'sometimes|required|string|max:255',
            'nom'    => 'sometimes|required|string|max:255',
            'date'   => 'sometimes|required|date',
            'heure'  => 'sometimes|required|date_format:H:i',
        ]);

        // Mise à jour de l'événement
        $event->update($validated);

        return response()->json($event);
    }

    public function destroy($id): JsonResponse
    {
        $event = Appointment::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Événement supprimé avec succès'], 200);
    }

    public function getAllEventsCalendar(): JsonResponse
    {
        // Récupérer les événements depuis la base de données
        $events = Appointment::all();

        // Transformer les données pour FullCalendar
        $formattedEvents = $events->map(function ($event) {
            return [
                'title'    => $event->prenom,
                'nom' => $event->nom,  // Titre affiché sur le calendrier
                'start' => $event->date,

            ];
        });

        return response()->json($formattedEvents);
    }

}
