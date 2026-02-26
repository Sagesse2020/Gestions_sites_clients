<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <style>
        /* ===== Reset & Global ===== */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', Arial, sans-serif; background: #f4f7fa; color: #333; }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 25px;
            color: #007bff;
        }

        /* Form */
        form { display: flex; flex-direction: column; gap: 15px; }

        label { font-weight: 500; margin-bottom: 5px; color: #555; }
        input, select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1em;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input:focus, select:focus { border-color: #007bff; background-color: #eef4fc; outline: none; }

        /* Buttons */
        .btn-container { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
        .btn-submit {
            background: #28a745; color: #fff;
            border: none; padding: 12px 25px;
            border-radius: 8px; cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover { background: #218838; transform: translateY(-2px); }
        .btn-retour {
            background: #007bff; color: #fff;
            text-decoration: none; padding: 12px 20px;
            border-radius: 8px; transition: 0.3s;
        }
        .btn-retour:hover { background: #0056b3; transform: translateY(-2px); }

        /* Errors */
        .alert {
            background: #f8d7da; color: #842029;
            border: 1px solid #f5c2c7;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 20px 15px; width: 90%; }
            .btn-container { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier un client</h1>

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

        <form action="{{ route('clients.update', $clients->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom du client</label>
            <input type="text" name="nom_client" value="{{ $clients->nom_client }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ $clients->email }}" required>

            <label>Slug (sous-domaine)</label>
            <input type="text" name="slug" value="{{ $clients->slug }}" required>

            <label>Site URL</label>
            <input type="url" name="site_url" value="{{ $clients->site_url }}" required>

            <label>Date de création</label>
            <input type="date" name="date_creation" value="{{ \Carbon\Carbon::parse($clients->date_creation)->format('Y-m-d') }}" required>

            <label>Date de renouvellement</label>
            <input type="date" name="date_renouvellement" value="{{ \Carbon\Carbon::parse($clients->date_renouvellement)->format('Y-m-d') }}" required>

            <label>Statut</label>
            <select name="statut" required>
                <option value="actif" {{ $clients->statut === 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ $clients->statut === 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>

            <div class="btn-container">
                <a href="{{ route('clients.index') }}" class="btn-retour">Retour</a>
                <button type="submit" class="btn-submit">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>
