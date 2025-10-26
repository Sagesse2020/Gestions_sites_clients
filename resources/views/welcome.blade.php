<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Tableau de Bord</title>
    <style>
        /* ===== CSS global ===== */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
        }

        header {
            background-color: #1e1e1e;
            color: white;
            padding: 30px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2em;
            letter-spacing: 1px;
        }

        main {
            margin: 50px auto;
            max-width: 600px;
            background-color: white;
            padding: 40px 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        main h2 {
            color: #00bcd4;
            margin-bottom: 20px;
        }

        main p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #00bcd4;
            color: white;
            text-decoration: none;
            font-weight: 500;
            border-radius: 30px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #02889b;
            transform: translateY(-3px);
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #1e1e1e;
            color: white;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mini Tableau de Bord</h1>
    </header>

    <main>
        <h2>Bienvenue Élysée !</h2>
        <p>Accédez au tableau de bord pour gérer vos clients et leurs sites hébergés.</p>
        <a href="{{ route('Client') }}" class="btn">Mes clients</a>
        <a href="{{ route('Create') }}" class="btn">Nouveau client</a>
    </main>

    <footer>
        &copy; 2025 Élysée. Tous droits réservés.
    </footer>
</body>
</html>
