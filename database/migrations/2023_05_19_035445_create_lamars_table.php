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
        Schema::create('lamars', function (Blueprint $table) {
            $table->id();
            $table->string("lamar_kd");
            $table->string("lamar_nm");
            $table->date("lamar_tgl_daftar");
            $table->string("lamar_NIM");
            $table->integer("lamar_id_loker");
            $table->timestamps();
            $table->index(['lamar_NIM', 'lamar_id_loker']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamars');
    }
};
