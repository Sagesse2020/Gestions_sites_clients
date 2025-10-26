<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSite extends Model
{
    protected $table = 'clients_sites';

    protected $fillable = [
        'nom_client',
        'email',
        'site_url',
        'date_creation',
        'date_renouvellement',
        'montant',
        'statut'
    ];
}
