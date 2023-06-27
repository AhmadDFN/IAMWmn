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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string("perusahaan_nm");
            $table->string("perusahaan_alamat");
            $table->string("perusahaan_kota");
            $table->string("perusahaan_notelp");
            $table->string("perusahaan_email");
            $table->string("perusahaan_website");
            $table->string("perusahaan_cp_nama")->nullable();
            $table->string("perusahaan_cp_notelp")->nullable();
            $table->string("perusahaan_foto")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
