<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $exists = Schedule::where('user_id', Auth::id())
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
            return redirect()->back()->withErrors(['error' => 'Ce créneau chevauche un créneau existant.']);
        }

        Schedule::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Créneau ajouté avec succès.');
    }

    public function show(Request $request)
    {
        //Recup Data for form
        $date = $request->input('date');
        $schedule = Schedule::where('date', $date)->get(['start_time', 'end_time']);
        return response()->json($schedule);
    }
}
