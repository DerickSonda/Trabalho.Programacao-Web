<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de filmes.
     */
    public function up(): void
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('sinopse');
            $table->integer('ano');
            $table->string('capa')->nullable();      // caminho da imagem da capa
            $table->string('trailer')->nullable();   // link do trailer no YouTube

            // Chaves estrangeiras: a categoria do filme e o usuário que cadastrou.
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Desfaz a migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
