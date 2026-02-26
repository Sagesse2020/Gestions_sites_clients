<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hébergements - Tableau de bord</title>
<style>
    body { font-family: 'Poppins', Arial, sans-serif; background: #f4f6f8; padding: 20px; }
    h1 { text-align: center; color: #4F46E5; margin-bottom: 30px; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.08); margin-bottom: 40px; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #e0e0e0; font-size: 0.95em; text-align: left; }
    th { background: #4F46E5; color: #fff; }
    tr:hover { background: #f1f3f8; }

    .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; color: #fff; font-size: 0.85em; border: none; cursor: pointer; transition: 0.3s; }
    .btn-edit { background: #007bff; }
    .btn-edit:hover { background: #0056b3; }
    .btn-delete { background: #e84118; }
    .btn-delete:hover { background: #c23616; }
    .btn-toggle { background: #44bd32; }
    .btn-toggle.suspendu { background: #fbc531; }

    .alert-banner { background: #e84118; color: white; padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-weight: bold; }
    .countdown { font-weight: bold; }

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

<h1>📊 Tableau de bord Hébergements</h1>

{{-- 🔔 Alertes --}}
@foreach ($hebergements as $hebergement)
    @php
        $fin = \Carbon\Carbon::parse($hebergement->date_fin);
        $joursRestants = \Carbon\Carbon::now()->diffInDays($fin, false);
    @endphp
    @if ($joursRestants <= 7 && $joursRestants >= 0)
        <div class="alert-banner">
            ⚠️ Hébergement <strong>{{ $hebergement->domaine }}</strong> expire dans
            <span class="countdown" id="countdown-banner-{{ $hebergement->id }}">{{ $joursRestants }} jour(s)</span>.
        </div>
    @endif
@endforeach

<table>
<thead>
<tr>
    <th>Client</th>
    <th>Email</th>
    <th>Domaine</th>
    <th>Début</th>
    <th>Fin</th>
    <th>Montant</th>
    <th>Statut</th>
    <th>Compte à rebours</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($hebergements as $hebergement)
    @php
        $fin = \Carbon\Carbon::parse($hebergement->date_fin);
        $joursRestants = \Carbon\Carbon::now()->diffInDays($fin, false);
    @endphp
<tr>
    <td data-label="Client">{{ $hebergement->clientSite->nom_client }}</td>
    <td data-label="Email">{{ $hebergement->clientSite->email }}</td>
    <td data-label="Domaine">{{ $hebergement->domaine }}</td>
    <td data-label="Début">{{ $hebergement->date_debut->format('d/m/Y') }}</td>
    <td data-label="Fin">{{ $hebergement->date_fin->format('d/m/Y') }}</td>
    <td data-label="Montant">{{ number_format($hebergement->montant,0,',',' ') }} FCFA</td>
    <td data-label="Statut"><span class="btn-toggle {{ $hebergement->statut }}">{{ ucfirst($hebergement->statut) }}</span></td>
    <td data-label="Compte à rebours">
        @if($joursRestants <= 7 && $joursRestants >= 0)
            <span class="countdown" id="countdown-{{ $hebergement->id }}">{{ $joursRestants }}j</span>
        @else -
        @endif
    </td>
    <td data-label="Action">
        <a href="{{ route('hebergements.edit', $hebergement->id) }}" class="btn btn-edit">Modifier</a>
        <form action="{{ route('hebergements.destroy', $hebergement->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cet hébergement ?')">Supprimer</button>
        </form>
        <form action="{{ route('hebergements.toggle', $hebergement->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-toggle {{ $hebergement->statut === 'actif' ? 'suspendu' : 'actif' }}">
                {{ $hebergement->statut === 'actif' ? 'Suspendre' : 'Activer' }}
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

{{-- JS compte à rebours --}}
<script>
@foreach ($hebergements as $hebergement)
    var countDownDate{{ $hebergement->id }} = new Date("{{ $hebergement->date_fin }}").getTime();
    var x{{ $hebergement->id }} = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate{{ $hebergement->id }} - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000*60*60));
        var minutes = Math.floor((distance % (1000*60*60)) / (1000*60));
        var seconds = Math.floor((distance % (1000*60)) / 1000);
        if(distance>0){
            document.getElementById("countdown-{{ $hebergement->id }}").innerHTML = days+"j "+hours+"h "+minutes+"m "+seconds+"s";
            if(document.getElementById("countdown-banner-{{ $hebergement->id }}")) {
                document.getElementById("countdown-banner-{{ $hebergement->id }}").innerHTML = days+"j "+hours+"h "+minutes+"m "+seconds+"s";
            }
        } else {
            document.getElementById("countdown-{{ $hebergement->id }}").innerHTML = "EXPIRE";
            if(document.getElementById("countdown-banner-{{ $hebergement->id }}")) {
                document.getElementById("countdown-banner-{{ $hebergement->id }}").innerHTML = "EXPIRE";
            }
            clearInterval(x{{ $hebergement->id }});
        }
    },1000);
@endforeach
</script>

</body>
</html>
