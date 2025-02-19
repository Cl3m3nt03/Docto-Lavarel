<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TakeAppointment extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::all();
        return response()->json($appointments);

    }

}
