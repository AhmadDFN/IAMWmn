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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string("berkas_kd", 15)->unique();
            $table->string("berkas_ktp")->nullable();
            $table->string("berkas_skck")->nullable();
            $table->string("berkas_kk")->nullable();
            $table->string("berkas_foto")->nullable();
            $table->string("berkas_cv")->nullable();
            $table->string("berkas_ijazah")->nullable();
            $table->string("berkas_NIM")->nullable();
            $table->timestamps();
            $table->index(["berkas_NIM"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
