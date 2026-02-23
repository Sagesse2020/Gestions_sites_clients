<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Alerte Hébergement CURSAGE</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2 style="color: #e84118;">⚠️ Alerte d’expiration d’hébergement</h2>
    <p>Bonjour {{ $hebergement->clientSite->nom_client }},</p>
    <p>Votre hébergement pour le domaine <strong>{{ $hebergement->domaine }}</strong> arrivera à expiration le
        <strong>{{ $hebergement->date_fin->format('d/m/Y') }}</strong>.</p>

    <p>Il vous reste <strong>{{ now()->diffInDays($hebergement->date_fin, false) }}</strong> jour(s)</strong> avant expiration.</p>

    <p>Veuillez renouveler votre hébergement avant cette date pour éviter toute suspension.</p>

    <p>Cordialement,</p>
    <p><strong>L’équipe CURSAGE</strong></p>
</body>
</html>
