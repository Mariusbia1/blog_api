<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();                              // ID auto-increment
            $table->foreignId('user_id')               // Clé étrangère vers users
                  ->constrained()
                  ->onDelete('cascade');               // Si user supprimé → blogs supprimés
            $table->string('title');                   // Titre du blog
            $table->text('content');                   // Contenu du blog
            $table->timestamps();                      // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
