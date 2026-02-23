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
     * Les commandes Artisan disponibles.
     *
     * @var array
     */
    protected $commands = [
        // Tu peux ajouter tes commandes personnalisées ici
        // 'App\Console\Commands\CheckHebergements',
    ];

    /**
     * Planification des tâches.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Vérification quotidienne des renouvellements
        $schedule->call(function () {

            $today = Carbon::today();

            $clients = ClientSite::all();

            foreach ($clients as $client) {

                $renouvellement = Carbon::parse($client->date_renouvellement);

                // Notifications 7 jours avant expiration (chaque jour)
                $diffDays = $today->diffInDays($renouvellement, false);
                if ($diffDays <= 7 && $diffDays >= 0) {
                    Mail::raw(
                        "Bonjour {$client->nom_client}, le renouvellement de votre site {$client->site_url} arrive à échéance le {$client->date_renouvellement}. Merci de procéder au paiement de {$client->montant} FCFA.",
                        function ($message) use ($client) {
                            $message->to($client->email)
                                    ->subject('Renouvellement d’hébergement');
                        }
                    );
                }

                // Mise à jour du statut automatiquement
                if ($today->greaterThan($renouvellement)) {
                    $client->statut = 'expiré';
                } elseif ($diffDays <= 7) {
                    $client->statut = 'à renouveler';
                } else {
                    $client->statut = 'actif';
                }

                $client->save();
            }

        })->dailyAt('08:00'); // exécute tous les jours à 8h
    }

    /**
     * Enregistrement des commandes Artisan.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
