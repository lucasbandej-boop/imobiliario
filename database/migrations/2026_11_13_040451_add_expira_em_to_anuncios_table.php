<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->timestamp('expira_em')->nullable();
        });

        DB::table('anuncios')->whereNull('expira_em')->update(['expira_em' => now()->addDays(30)]);
    }

    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('expira_em');
        });
    }
};
