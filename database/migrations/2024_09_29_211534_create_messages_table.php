<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id'); // ID de l'expéditeur (client ou admin)
            $table->unsignedBigInteger('receiver_id'); // ID du destinataire (client ou admin)
            $table->text('message');
            $table->timestamps();

            // Optionnel: tu peux ajouter des index sur ces colonnes si nécessaire
            $table->index(['sender_id', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
