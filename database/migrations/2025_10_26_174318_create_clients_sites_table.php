<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients_sites', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->string('email');
            $table->string('site_url');
            $table->date('date_creation');
            $table->date('date_renouvellement');
            $table->integer('montant');
            $table->enum('statut', ['actif', 'expire', 'bientot', 'Bientôt à renouveler'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients_sites');
    }
};
