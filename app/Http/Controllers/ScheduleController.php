<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function schedule()
    {
        return view('calendar', [
            'schedules' => Schedule::all()
        ]);
    }
}

