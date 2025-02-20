<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappel de Rendez-vous</title>
</head>
<body>
<h1>Bonjour {{ $appointment->user->name }},</h1>
<p>Ce message est un rappel concernant votre rendez-vous prévu pour le {{ $appointment->date }} à {{ $appointment->time }}.</p>
<p>Nous vous remercions de bien vouloir être à l'heure.</p>
<p>Cordialement,</p>
<p>L'équipe de DoctorLaravel</p>
</body>
</html>
