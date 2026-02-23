<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Hébergements CURSAGE</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; margin: 20px; }
        h1 { color: #2f3640; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; }
        th { background: #273c75; color: white; text-align: left; }
        tr:hover { background: #f1f2f6; }
        .btn { padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; color: white; }
        .actif { background-color: #44bd32; }
        .suspendu { background-color: #e84118; }
        .alerte { background-color: #fbc531; }
        .expiré { background-color: #718093; }
        .alert-banner { background:#e84118;color:white;padding:10px;border-radius:8px;margin-bottom:10px; }
        .countdown { font-weight: bold; color: #e84118; }
    </style>
</head>
<body>

<h1>Tableau de bord - Hébergements Clients</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

{{-- Boucle pour afficher les alertes pour les hébergements proches de la date de fin --}}
@foreach ($hebergements as $hebergement)
    @php
        $fin = \Carbon\Carbon::parse($hebergement->date_fin);
        $joursRestants = \Carbon\Carbon::now()->diffInDays($fin, false);
    @endphp

    @if ($joursRestants <= 7 && $joursRestants >= 0)
        <div class="alert-banner">
            ⚠️ L’hébergement du domaine <strong>{{ $hebergement->domaine }}</strong> expire dans
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
            <th>Date début</th>
            <th>Date fin</th>
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
                <td>{{ $hebergement->clientSite->nom_client }}</td>
                <td>{{ $hebergement->clientSite->email }}</td>
                <td>{{ $hebergement->domaine }}</td>
                <td>{{ $hebergement->date_debut->format('d/m/Y') }}</td>
                <td>{{ $hebergement->date_fin->format('d/m/Y') }}</td>
                <td>{{ $hebergement->montant }} FCFA</td>
                <td>
                    <span class="btn {{ $hebergement->statut }}">
                        {{ ucfirst($hebergement->statut) }}
                    </span>
                </td>
                <td>
                    @if($joursRestants <= 7 && $joursRestants >= 0)
                        <span class="countdown" id="countdown-{{ $hebergement->id }}">
                            {{ $joursRestants }} jour(s)
                        </span>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <form action="{{ route('hebergements.toggle', $hebergement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $hebergement->statut === 'actif' ? 'suspendu' : 'actif' }}">
                            {{ $hebergement->statut === 'actif' ? 'Suspendre' : 'Activer' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- JavaScript pour le compte à rebours dynamique --}}
<script>
@foreach ($hebergements as $hebergement)
    @php $fin = \Carbon\Carbon::parse($hebergement->date_fin); @endphp
    var countDownDate{{ $hebergement->id }} = new Date("{{ $fin->format('Y-m-d H:i:s') }}").getTime();

    var x{{ $hebergement->id }} = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate{{ $hebergement->id }} - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(distance > 0){
            document.getElementById("countdown-{{ $hebergement->id }}").innerHTML = days + "j "
                + hours + "h " + minutes + "m " + seconds + "s ";
            document.getElementById("countdown-banner-{{ $hebergement->id }}").innerHTML = days + "j "
                + hours + "h " + minutes + "m " + seconds + "s ";
        } else {
            document.getElementById("countdown-{{ $hebergement->id }}").innerHTML = "EXPIRE";
            document.getElementById("countdown-banner-{{ $hebergement->id }}").innerHTML = "EXPIRE";
            clearInterval(x{{ $hebergement->id }});
        }
    }, 1000);
@endforeach
</script>

</body>
</html>
