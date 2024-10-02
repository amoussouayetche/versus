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
            $table->string('sender_type'); // Type de l'expéditeur: 'client' ou 'admin'
            $table->string('receiver_type'); // Type du destinataire: 'client' ou 'admin'
            $table->text('message'); // Contenu du message
            $table->timestamps();
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
