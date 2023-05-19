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
        Schema::create('jenis_lokers', function (Blueprint $table) {
            $table->id();
            $table->string("loker_kd")->unique();
            $table->string("loker_nm");
            $table->string("loker_ket");
            $table->dateTime("loker_exp");
            $table->string("loker_kd_jurusan");
            $table->integer("loker_status");
            $table->integer("loker_id_perusahaan");
            $table->integer("loker_id_jnsloker");
            $table->timestamps();
            $table->index(['loker_kd_jurusan','loker_id_perusahaan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_lokers');
    }
};
