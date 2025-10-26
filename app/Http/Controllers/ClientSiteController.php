<?php

namespace App\Http\Controllers;

use App\Models\ClientSite;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientSiteController extends Controller
{
    /**
     * Affiche la liste des clients.
     */
    public function index()
    {
        $clients = ClientSite::all();

        // Met à jour les statuts automatiquement
        foreach ($clients as $client) {
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($client->date_renouvellement), false);

            if ($daysLeft <= 0) {
                $client->update(['statut' => 'Expiré']);
            } elseif ($daysLeft <= 15) {
                $client->update(['statut' => 'Bientôt à renouveler']);
            } else {
                $client->update(['statut' => 'Actif']);
            }
        }

        return view('client', compact('clients'));
    }

    /**
     * Affiche la vue de création d’un client.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Enregistre un nouveau client dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'site_url' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'date_renouvellement' => 'required|date|after_or_equal:date_creation',
            'montant' => 'required|integer',
        ]);

        // Correction automatique de l’URL
        $url = $request->site_url;
        if (!preg_match('/^https?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        // Enregistrement du client
        ClientSite::create([
            'nom_client' => $request->nom_client,
            'email' => $request->email,
            'site_url' => $url,
            'date_creation' => $request->date_creation,
            'date_renouvellement' => $request->date_renouvellement,
            'montant' => $request->montant,
            'statut' => 'Actif',
        ]);

        return redirect()->route('Client')->with('success', 'Client ajouté avec succès !');
    }
}
