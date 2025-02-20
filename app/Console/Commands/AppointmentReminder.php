<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment; // Si tu as un modèle Appointment pour récupérer les rendez-vous
use App\Mail\AppointmentReminderMail; // Le mail de rappel que tu vas créer
use Carbon\Carbon;

class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie un email de rappel pour les rendez-vous à venir';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Récupérer les rendez-vous du jour ou de demain (par exemple)
        $appointments = Appointment::whereDate('date', Carbon::tomorrow()->toDateString())
            ->get();

        foreach ($appointments as $appointment) {
            $user = $appointment->user;  // Supposons que chaque rendez-vous a un utilisateur associé

            // Envoyer un email de rappel
            Mail::to($user->email)->send(new AppointmentReminderMail($appointment));

            $this->info("Rappel envoyé pour le rendez-vous de {$user->name}.");
        }

        $this->info('Tous les rappels ont été envoyés !');
    }
}
