<?php

namespace App\Http\Controllers;

use App\Models\HebergementClient;
use App\Models\ClientSite;
use Illuminate\Http\Request;

class HebergementClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hebergements = HebergementClient::with('clientSite')->get();
        return view('hebergements.index', compact('hebergements'));
    }

    /**
     * Toggle le statut actif/suspendu d'un hébergement.
     */
    public function toggleStatut($id)
    {
        $hebergement = HebergementClient::findOrFail($id);

        // Inversion du statut
        if ($hebergement->statut === 'actif') {
            $hebergement->statut = 'suspendu';
        } else {
            $hebergement->statut = 'actif';
        }

        $hebergement->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès !');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer tous les clients pour la liste déroulante
        $clients = ClientSite::all();
        return view('hebergements.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'client_site_id' => 'required|exists:clients_sites,id',
            'domaine' => 'required|string|unique:hebergements_clients,domaine',
            'dossier_site' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'montant' => 'required|numeric|min:0',
            'moyen_paiement' => 'nullable|string',
            'statut' => 'required|in:actif,en_alerte,suspendu,expiré',
        ]);

        // Création de l'hébergement
        HebergementClient::create([
            'client_site_id' => $request->client_site_id,
            'domaine' => $request->domaine,
            'dossier_site' => $request->dossier_site,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant' => $request->montant,
            'moyen_paiement' => $request->moyen_paiement,
            'statut' => $request->statut,
        ]);

        return redirect()->route('hebergements.index')->with('success', 'Hébergement ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(HebergementClient $hebergementClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HebergementClient $hebergementClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HebergementClient $hebergementClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HebergementClient $hebergementClient)
    {
        //
    }
}
