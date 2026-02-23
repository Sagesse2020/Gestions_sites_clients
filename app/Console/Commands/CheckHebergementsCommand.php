<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HebergementClient;
use App\Mail\HebergementExpirationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckHebergementsCommand extends Command
{
    protected $signature = 'hebergements:check';
    protected $description = 'Vérifie les hébergements et envoie les alertes avant expiration';

    public function handle()
    {
        $today = Carbon::now();
        $hebergements = HebergementClient::with('clientSite')->get();

        foreach ($hebergements as $hebergement) {
            $dateFin = Carbon::parse($hebergement->date_fin);
            $joursRestants = $today->diffInDays($dateFin, false);

            // 📬 Envoie du mail si expiration dans 7 jours ou moins
            if ($joursRestants <= 7 && $joursRestants >= 0 && !$hebergement->alerte_envoyee) {
                Mail::to($hebergement->clientSite->email)
                    ->send(new HebergementExpirationMail($hebergement));

                $hebergement->alerte_envoyee = true;
                $hebergement->save();

                $this->info("Alerte envoyée à {$hebergement->clientSite->email}");
            }

            // ❌ Si la date est dépassée → on suspend
            if ($joursRestants < 0 && $hebergement->statut !== 'expiré') {
                $hebergement->statut = 'expiré';
                $hebergement->save();
                $this->info("Hébergement expiré : {$hebergement->domaine}");
            }
        }

        return Command::SUCCESS;
    }
}
