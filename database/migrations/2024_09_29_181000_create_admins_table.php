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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('specialite');
            $table->string('password');
            $table->timestamps();
        });

        DB::table('admins')->insert([
            [
                'name' => 'Dr. Weber',
                'email' => 'weber@example.com',
                'specialite' => 'Sexologue',
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Martin',
                'email' => 'martin@example.com',
                'specialite' => 'Cardiologue',
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Durand',
                'email' => 'durand@example.com',
                'specialite' => 'Dermatologue',
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Moreau',
                'email' => 'moreau@example.com',
                'specialite' => 'Psychologue',
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Lefevre',
                'email' => 'lefevre@example.com',
                'specialite' => 'Neurologue',
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
