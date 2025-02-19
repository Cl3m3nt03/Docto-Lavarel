<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class contactController extends Controller
{
    public function sendMail()
    {
        $details = [
            'name' => 'Bonjour Melina ! ',
            'email' => 'Doctorlaravel',
            'message' => 'Ceci est un message de test. Et bienvenue sur Bonjour Melina !'
        ];

        Mail::to('melinaseurin@gmail.com')->send(new ContactMail($details));

        return "E-mail envoyé avec succès !";
    }
}
