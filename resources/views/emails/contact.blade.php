<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de Contact</title>
</head>
<body>
<h2>Nouveau Message de Contact</h2>
<p><strong>Nom :</strong> {{ $details['name'] }}</p>
<p><strong>Email :</strong> {{ $details['email'] }}</p>
<p><strong>Message :</strong> {{ $details['message'] }}</p>
</body>
</html>
