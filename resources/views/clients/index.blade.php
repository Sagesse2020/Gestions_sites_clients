<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clients - Tableau de bord</title>
<style>
    body { font-family: 'Poppins', Arial, sans-serif; background: #f4f6f8; padding: 20px; }
    h1 { text-align: center; color: #4F46E5; margin-bottom: 30px; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.08); margin-bottom: 40px; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: left; font-size: 0.95em; }
    th { background: #4F46E5; color: #fff; }
    tr:hover { background: #f1f3f8; }

    .actif { color: #28a745; font-weight: bold; }
    .bientot { color: #ff9800; font-weight: bold; }
    .expire { color: #e84118; font-weight: bold; }

    .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; color: #fff; font-size: 0.85em; border: none; cursor: pointer; transition: 0.3s; }
    .btn-edit { background: #007bff; }
    .btn-edit:hover { background: #0056b3; }
    .btn-delete { background: #e84118; }
    .btn-delete:hover { background: #c23616; }

    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr { display: block; }
        tr { margin-bottom: 15px; border-bottom: 2px solid #ddd; }
        th { display: none; }
        td { position: relative; padding-left: 50%; margin-bottom: 10px; }
        td::before { content: attr(data-label); position: absolute; left: 15px; font-weight: bold; color: #555; }
    }
</style>
</head>
<body>

<h1>📊 Tableau de bord Clients</h1>

<table>
<thead>
<tr>
    <th>Nom</th>
    <th>Email</th>
    <th>Site</th>
    <th>Création</th>
    <th>Renouvellement</th>
    <th>Montant</th>
    <th>Statut</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($clients as $client)
<tr>
    <td data-label="Nom">{{ $client->nom_client }}</td>
    <td data-label="Email">{{ $client->email }}</td>
    <td data-label="Site">
        <a href="{{ preg_match('/^https?:\/\//', $client->site_url) ? $client->site_url : 'https://'.$client->site_url }}" target="_blank">
            {{ $client->site_url }}
        </a>
    </td>
    <td data-label="Création">{{ \Carbon\Carbon::parse($client->date_creation)->format('d/m/Y') }}</td>
    <td data-label="Renouvellement">{{ \Carbon\Carbon::parse($client->date_renouvellement)->format('d/m/Y') }}</td>
    <td data-label="Montant">{{ number_format($client->montant,0,',',' ') }} FCFA</td>
    <td data-label="Statut" class="{{ $client->statut }}">
        @if ($client->statut == 'actif') 🟢 Actif
        @elseif ($client->statut == 'bientot') 🟠 À renouveler
        @else 🔴 Expiré
        @endif
    </td>
    <td data-label="Action">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-edit">Modifier</a>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer ce client ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>
