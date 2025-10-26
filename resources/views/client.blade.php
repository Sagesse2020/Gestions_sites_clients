<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Gestion des clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 40px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4F46E5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #4F46E5;
            color: white;
        }
        a {
            color: #00bcd4;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .actif { color: green; font-weight: bold; }
        .bientot { color: orange; font-weight: bold; }
        .expire { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>📊 Tableau de bord des sites clients</h2>

    <table>
        <thead>
            <tr>
                <th>Nom du client</th>
                <th>Email</th>
                <th>URL du site</th>
                <th>Date de création</th>
                <th>Date de renouvellement</th>
                <th>Montant (FCFA)</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->nom_client }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="{{ preg_match('/^https?:\/\//', $client->site_url) ? $client->site_url : 'https://' . $client->site_url }}" target="_blank" rel="noopener noreferrer">
                        {{ $client->site_url }}
                    </a>
                </td>
                <td>{{ \Carbon\Carbon::parse($client->date_creation)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($client->date_renouvellement)->format('d/m/Y') }}</td>
                <td>{{ number_format($client->montant, 0, ',', ' ') }}</td>
                <td class="{{ $client->statut }}">
                    @if ($client->statut == 'actif') 🟢 Actif
                    @elseif ($client->statut == 'bientot') 🟠 À renouveler bientôt
                    @else 🔴 Expiré
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
