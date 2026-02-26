<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un hébergement</title>
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; background: #f4f7fa; color: #333; }
        .container {
            max-width: 700px; margin: 40px auto; background: #fff;
            padding: 30px 25px; border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h1 { text-align: center; font-size: 2em; margin-bottom: 25px; color: #007bff; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: 500; margin-bottom: 5px; color: #555; }
        input, select { width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #ccc; font-size: 1em; background: #f9f9f9; transition: all 0.3s; }
        input:focus, select:focus { border-color: #007bff; background: #eef4fc; outline: none; }

        .btn-container { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
        .btn-submit { background: #28a745; color: #fff; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { background: #218838; transform: translateY(-2px); }
        .btn-retour { background: #007bff; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 8px; transition: 0.3s; }
        .btn-retour:hover { background: #0056b3; transform: translateY(-2px); }

        .alert { background: #f8d7da; color: #842029; border: 1px solid #f5c2c7; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; }

        @media (max-width: 768px) {
            .container { width: 90%; padding: 20px 15px; }
            .btn-container { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier un hébergement</h1>

        @if ($errors->any())
        <div class="alert">
            <strong>Attention :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('hebergements.update', $hebergement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom du client</label>
            <input type="text" value="{{ $hebergement->clientSite->nom_client }}" disabled>

            <label>Email du client</label>
            <input type="text" value="{{ $hebergement->clientSite->email }}" disabled>

            <label>Domaine</label>
            <input type="text" name="domaine" value="{{ $hebergement->domaine }}" required>

            <label>Date de début</label>
            <input type="date" name="date_debut" value="{{ \Carbon\Carbon::parse($hebergement->date_debut)->format('Y-m-d') }}" required>

            <label>Date de fin</label>
            <input type="date" name="date_fin" value="{{ \Carbon\Carbon::parse($hebergement->date_fin)->format('Y-m-d') }}" required>

            <label>Montant (FCFA)</label>
            <input type="number" name="montant" value="{{ $hebergement->montant }}" required>

            <label>Statut</label>
            <select name="statut" required>
                <option value="actif" {{ $hebergement->statut === 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="suspendu" {{ $hebergement->statut === 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                <option value="expiré" {{ $hebergement->statut === 'expiré' ? 'selected' : '' }}>Expiré</option>
            </select>

            <div class="btn-container">
                <a href="{{ route('hebergements.index') }}" class="btn-retour">Retour</a>
                <button type="submit" class="btn-submit">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>
