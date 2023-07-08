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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string("mhs_NIM", 10)->unique();
            $table->string("mhs_nm", 80);
            $table->string("mhs_email", 50);
            $table->integer("mhs_jk")->default(1);
            $table->string("mhs_notelp")->nullable();
            $table->year("mhs_th_masuk");
            $table->year("mhs_th_lulus");
            $table->string("mhs_kota_lahir", 50);
            $table->Date("mhs_tanggal_lahir");
            $table->string("mhs_alamat", 100);
            $table->string("mhs_kota", 50);
            $table->integer("mhs_tb")->nullable();
            $table->integer("mhs_bb")->nullable();
            $table->integer("mhs_status")->default(1);
            $table->string("mhs_foto")->nullable();
            $table->string("mhs_kd_jurusan")->nullable();
            $table->timestamps();
            $table->index(['mhs_kd_jurusan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
