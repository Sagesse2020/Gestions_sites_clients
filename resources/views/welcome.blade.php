<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Tableau de Bord</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ===== CSS Global ===== */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #1e1e1e;
            color: white;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2em;
            letter-spacing: 1px;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 30px auto;
            padding: 30px 20px;
            width: 90%;
            max-width: 800px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        main:hover {
            transform: translateY(-5px);
        }

        main h2 {
            color: #00bcd4;
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        main p {
            font-size: 1.1em;
            margin-bottom: 25px;
        }

        .btn-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            flex: 1 1 200px;
            padding: 12px 25px;
            background-color: #00bcd4;
            color: white;
            text-decoration: none;
            font-weight: 500;
            border-radius: 30px;
            transition: background 0.3s ease, transform 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background-color: #02889b;
            transform: translateY(-3px);
        }

        footer {
            padding: 15px 20px;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
            font-size: 0.9em;
        }

        /* ===== Responsive ===== */
        @media (max-width: 600px) {
            header h1 {
                font-size: 1.5em;
            }
            main h2 {
                font-size: 1.5em;
            }
            .btn {
                flex: 1 1 100%;
            }
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
        <div class="btn-container">
            <a href="{{ route('clients.index') }}" class="btn">Mes clients</a>
            <a href="{{ route('clients.create') }}" class="btn">Nouveau client</a>
            <a href="{{ route('github.index') }}" class="btn">Github</a>
            <a href="{{ route('hebergements.create') }}" class="btn">Nouvel Hébergement</a>
            <a href="{{ route('hebergements.index') }}" class="btn">Hébergements</a>
        </div>
    </main>

    <footer>
        &copy; 2025 Élysée. Tous droits réservés.
    </footer>
</body>
</html>
