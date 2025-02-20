<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class contactController extends Controller
{

    public function index()
    {
        $Mail = Appointment::all();

        return response()->json($Mail);
    }

    public function sendMail()
    {

        $Mail = Auth::user()->email;
        $Pseudo = Auth::user()->name;

        $details = [
            'name' => $Pseudo,
            'email' => 'Ceci est mail de Doctorlaravel',
            'message' => 'Ceci est un message de test. Et bienvenue sur Doctor laravel !'
        ];

        Mail::to($Mail)->send(new ContactMail($details));

        return redirect()->back()->with('status', 'E-mail envoyé avec succès !');
    }




}
