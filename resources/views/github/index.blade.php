<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes dépôts GitHub – Élysée</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; color: #333; }
        .container { max-width: 900px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 10px; }
        h1 { text-align: center; color: #00bcd4; }
        .repo { padding: 15px; border-bottom: 1px solid #eee; }
        a { color: #00bcd4; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Mon dépôt GitHub</h1>
    <p>Voici mon profil GitHub :</p>
    <a href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer">
        {{ $githubName }}
    </a>
</body>
</html>
