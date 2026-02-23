<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HebergementClient extends Model
{
    use HasFactory;
    protected $table  = 'hebergements_clients';

    protected $fillable = [
        'client_site_id',
        'domaine',
        'dossier_site',
        'date_debut',
        'date_fin',
        'montant',
        'moyen_paiement',
        'statut'
    ];

    protected $casts = [
    'date_debut' => 'datetime',
    'date_fin' => 'datetime',
    ];

    public function clientSite()
    {
        return $this->belongsTo(ClientSite::class, 'client_site_id');
    }
}
