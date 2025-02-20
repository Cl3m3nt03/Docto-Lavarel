<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    function calendar() {

        return view('calendar', [
            'appointments' => Appointment::all()
        ]);
    }

    public function destroy($id){
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success','Le rendez-vous à bien été annuler !');
    }


}
