<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Clients - Tableau de bord</title>

<style>
body { font-family: Poppins, Arial; background: #f4f6f8; padding: 20px; }
table { width:100%; background:#fff; border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,.08); border-collapse: collapse; }
th,td { padding:12px; border-bottom:1px solid #eee; }
th { background:#4F46E5; color:#fff; }

.actif { color:#28a745; font-weight:bold; }
.bientot { color:#ff9800; font-weight:bold; }
.expire { color:#e84118; font-weight:bold; }

.btn { padding:6px 10px; border-radius:5px; color:#fff; text-decoration:none; font-size:0.85em; }
.btn-edit { background:#007bff; }
.btn-delete { background:#e84118; }
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
@foreach($clients as $client)
<tr>
<td>{{ $client->nom_client }}</td>
<td>{{ $client->email }}</td>
<td>
<a href="{{ $client->site_url }}" target="_blank">
{{ $client->site_url }}
</a>
</td>
<td>{{ \Carbon\Carbon::parse($client->date_creation)->format('d/m/Y') }}</td>
<td>{{ \Carbon\Carbon::parse($client->date_renouvellement)->format('d/m/Y') }}</td>
<td>{{ number_format($client->montant,0,',',' ') }} FCFA</td>

<td class="{{ $client->statut }}">
@if($client->statut === 'actif') 🟢 Actif
@elseif($client->statut === 'bientot') 🟠 À renouveler
@else 🔴 Expiré
@endif
</td>

<td>
<a href="{{ route('clients.edit',$client->id) }}" class="btn btn-edit">Modifier</a>

<form action="{{ route('clients.destroy',$client->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-delete">Supprimer</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>
