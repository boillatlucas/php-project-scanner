<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Prise de contact sur l'application {{ env('APP_NAME') }}</h2>
<p>Réception d'une prise de contact avec les éléments suivants :</p>
<ul>
    <li><strong>Nom</strong> : {{ $contact['fullname'] }}</li>
    <li><strong>Email</strong> : {{ $contact['email'] }}</li>
    <li><strong>Sujet</strong> : {{ $contact['sujet'] }}</li>
    <li><strong>Message</strong> : <br>
        {{ $contact['message'] }}</li>
</ul>
</body>
</html>