<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $this->authorize('create', Schedule::class);
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $exists = Schedule::where('doctor_id', Auth::id())
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                    })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '>', $request->start_time)
                            ->where('end_time', '<', $request->end_time);
                    });
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => '🚫 Ce créneau chevauche un créneau existant.']);
        }

        Schedule::create([
            'user_id' => Auth::id(),
            'doctor_id' => Auth::id(),
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.index')->with('success', '✅ Créneau ajouté avec succès.');
    }

    public function show(Request $request)
    {
        // Récupération de la date du formulaire
        $date       = $request->input('date');
        $schedule   = Schedule::where('date', $date)->first(['start_time', 'end_time']);
        $data       = [];
        $availableTimes = [];

        $appointmentsData = [];
        $appointments = Appointment::where('date', $date)->get(['horraire']);

        foreach ($appointments as $appointment) {
            $appointmentsData[] = Carbon::parse($appointment->horraire)->format('H:i');
        }

        if ($schedule) {
            $start  = Carbon::parse($schedule->start_time);
            $end    = Carbon::parse($schedule->end_time);
            $hours  = $start->diffInHours($end);

            for ($i = 0; $i < $hours; $i++) {
                $availableTime = $start->copy()->addHours($i)->format('H:i');

                if (!in_array($availableTime, $appointmentsData)) {
                    $availableTimes[] = $availableTime;
                }
            }
        }

        if (count($availableTimes) > 0) {
            return response()->json([
                'available_times' => $availableTimes,
                'message' => 'Les horaires sont disponibles.'
            ]);
        }

        return response()->json([
            'message' => 'Il n\'y a pas d\'horaires disponibles pour cette date.'
        ]);
    }

}
