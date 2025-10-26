<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ClientSite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Définir les commandes Artisan.
     *
     * @var array
     */
    protected $commands = [
        // Tu peux ajouter ici tes commandes personnalisées
    ];

    /**
     * Définir le planning des tâches.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Tâche quotidienne pour vérifier les renouvellements
        $schedule->call(function () {

            $today = Carbon::today();

            // Parcours tous les clients
            $clients = ClientSite::all();

            foreach ($clients as $client) {

                $renouvellement = Carbon::parse($client->date_renouvellement);

                // 15 jours avant la date de renouvellement
                if ($today->diffInDays($renouvellement, false) === 15) {
                    // Exemple : envoi d'email (tu dois créer une Mailable)
                    Mail::raw(
                        "Bonjour {$client->nom_client}, le renouvellement de votre site {$client->site_url} arrive à échéance le {$client->date_renouvellement}. Merci de procéder au paiement de {$client->montant} FCFA.",
                        function ($message) use ($client) {
                            $message->to($client->email)
                                    ->subject('Renouvellement d’hébergement');
                        }
                    );
                }

                // Mise à jour du statut
                if ($today->greaterThan($renouvellement)) {
                    $client->statut = 'Expiré';
                } elseif ($today->diffInDays($renouvellement, false) <= 15) {
                    $client->statut = 'À renouveler';
                } else {
                    $client->statut = 'Actif';
                }

                $client->save();
            }

        })->daily(); // s'exécute tous les jours
    }

    /**
     * Enregistrer les commandes Artisan.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
