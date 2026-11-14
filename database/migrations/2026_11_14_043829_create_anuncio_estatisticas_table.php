<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anuncio_estatisticas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anuncio_id')->constrained()->cascadeOnDelete();
            $table->date('data');
            $table->unsignedInteger('visitas')->default(0);
            $table->unsignedInteger('contactos')->default(0);
            $table->unique(['anuncio_id', 'data']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncio_estatisticas');
    }
};
