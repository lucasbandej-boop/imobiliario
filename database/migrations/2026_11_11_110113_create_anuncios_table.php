<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('titulo');
            $table->string('tipo');        // casa, apartamento, terreno
            $table->string('finalidade');  // arrendar, vender
            $table->decimal('preco', 14, 2);
            $table->string('moeda')->default('AOA');
            $table->string('provincia');
            $table->string('municipio')->nullable();
            $table->string('bairro')->nullable();
            $table->unsignedTinyInteger('quartos')->nullable();
            $table->unsignedTinyInteger('casas_banho')->nullable();
            $table->text('descricao')->nullable();
            $table->string('whatsapp');
            $table->json('fotos')->nullable();
            $table->string('estado')->default('ativo'); // ativo, arrendado, vendido
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
