<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hebergements_clients', function (Blueprint $table) {
            $table->id();

            // Liaison avec la table clients_sites
            $table->foreignId('client_site_id')->constrained('clients_sites')->onDelete('cascade');

            $table->string('domaine')->unique(); // ex : client.com
            $table->string('dossier_site'); // ex : dossier du site sur ton serveur
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('montant', 10, 2);
            $table->string('moyen_paiement')->nullable();
            $table->enum('statut', ['actif', 'en_alerte', 'suspendu', 'expiré'])->default('actif');
            $table->boolean('alerte_envoyee')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hebergements_clients');
    }
};
