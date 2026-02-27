<?php

namespace App\Http\Controllers;

use App\Models\ClientSite;
use App\Models\HebergementClient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientSiteController extends Controller
{
    public function index()
    {
        $clients = ClientSite::all();

        foreach ($clients as $client) {
            $today = Carbon::today();
            $renewal = Carbon::parse($client->date_renouvellement);

            if ($renewal->lt($today)) {
                $client->statut = 'expire';
            } elseif ($renewal->diffInDays($today) <= 15) {
                $client->statut = 'bientot';
            } else {
                $client->statut = 'actif';
            }

            $client->save();
        }

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'site_url' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'date_renouvellement' => 'required|date|after_or_equal:date_creation',
            'montant' => 'required|integer',
        ]);

        $url = $request->site_url;
        if (!preg_match('/^https?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        ClientSite::create([
            'nom_client' => $request->nom_client,
            'email' => $request->email,
            'site_url' => $url,
            'date_creation' => $request->date_creation,
            'date_renouvellement' => $request->date_renouvellement,
            'montant' => $request->montant,
            'statut' => 'actif',
        ]);

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès');
    }

    public function edit($id)
    {
        $clients = ClientSite::findOrFail($id);
        $hebergements = HebergementClient::all();
        return view('clients.edit', compact('clients', 'hebergements'));
    }

    public function update(Request $request, $id)
    {
        $client = ClientSite::findOrFail($id);
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        ClientSite::findOrFail($id)->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé');
    }
}
