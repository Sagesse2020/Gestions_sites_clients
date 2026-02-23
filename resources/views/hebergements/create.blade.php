<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Hébergement - CURSAGE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2f3640;
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #2f3640;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #273c75;
            box-shadow: 0 0 5px rgba(39, 60, 117, 0.3);
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background: #273c75;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #192a56;
        }
        .errors {
            background: #e84118;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .errors ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ajouter un Hébergement</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hebergements.store') }}" method="POST">
        @csrf

        <label for="client_site_id">Client</label>
        <select name="client_site_id" id="client_site_id" required>
            <option value="">-- Sélectionner un client --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom_client }} ({{ $client->email }})</option>
            @endforeach
        </select>

        <label for="domaine">Domaine</label>
        <input type="text" name="domaine" id="domaine" placeholder="ex: monsite.com" required>

        <label for="dossier_site">Dossier site</label>
        <input type="text" name="dossier_site" id="dossier_site" placeholder="ex: monsite/" required>

        <label for="date_debut">Date de début</label>
        <input type="date" name="date_debut" id="date_debut" required>

        <label for="date_fin">Date de fin</label>
        <input type="date" name="date_fin" id="date_fin" required>

        <label for="montant">Montant (FCFA)</label>
        <input type="number" name="montant" id="montant" placeholder="ex: 50000" required>

        <label for="moyen_paiement">Moyen de paiement</label>
        <select name="moyen_paiement" id="moyen_paiement">
            <option value="">-- Sélectionner --</option>
            <option value="Cash">Cash</option>
            <option value="Mobile Money">Mobile Money</option>
            <option value="Virement bancaire">Virement bancaire</option>
        </select>

        <label for="statut">Statut</label>
        <select name="statut" id="statut" required>
            <option value="actif">Actif</option>
            <option value="en_alerte">En alerte</option>
            <option value="suspendu">Suspendu</option>
            <option value="expiré">Expiré</option>
        </select>

        <button type="submit">Ajouter l'hébergement</button>
    </form>
</div>

</body>
</html>
