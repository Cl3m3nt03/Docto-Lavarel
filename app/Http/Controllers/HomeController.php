<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'appointments' => Appointment::all(),
        ]);
    }

    public function getScheduleHours(Request $request)
    {
        $date = $request->input('date');
        $appointments = Appointment::whereDate('date', $date)->get();

        $busyHours = [];
        foreach ($appointments as $appointment) {
            $busyHours[] = $appointment->horraire;
        }

        return response()->json($busyHours);
    }
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'date' => 'required|date',
            'horraire' => 'required',
        ]);

        Appointment::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'horraire' => $request->horraire,
        ]);

        return redirect()->back()->with('success', 'Rendez-vous enregistré avec succès !');
    }

}
