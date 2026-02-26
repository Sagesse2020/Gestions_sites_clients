<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        header {
            background: #1e1e1e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
        }

        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: auto;
            background: #00bcd4;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            padding: 12px 25px;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #02889b;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ajouter un Client</h1>
    </header>

    <main>
        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        {{-- Formulaire d’ajout --}}
        <form action="{{ route('Store') }}" method="POST">
            @csrf

            <label for="nom_client">Nom du client :</label>
            <input type="text" name="nom_client" id="nom_client" value="{{ old('nom_client') }}" required>
            @error('nom_client') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="site_url">URL du site :</label>
            <input type="text" name="site_url" id="site_url" value="{{ old('site_url') }}" placeholder="ex : https://sagesse2020.github.io/portfolio/" required>
            @error('site_url') <div class="error">{{ $message }}</div> @enderror

            <label for="date_creation">Date de création :</label>
            <input type="date" name="date_creation" id="date_creation" value="{{ old('date_creation') }}" required>

            <label for="date_renouvellement">Date de renouvellement :</label>
            <input type="date" name="date_renouvellement" id="date_renouvellement" value="{{ old('date_renouvellement') }}" required>

            <label for="montant">Montant (FCFA) :</label>
            <input type="number" name="montant" id="montant" value="{{ old('montant') }}" required>

            <input type="submit" value="Ajouter Client">
        </form>
    </main>
</body>
</html>
