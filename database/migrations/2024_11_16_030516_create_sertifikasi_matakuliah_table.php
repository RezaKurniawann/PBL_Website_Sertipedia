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
        Schema::create('t_sertifikasi_matakuliah', function (Blueprint $table) {
            $table->id('id_sertifikasi_matakuliah');
            $table -> unsignedBigInteger('id_sertifikasi') -> index;
            $table -> unsignedBigInteger('id_matakuliah') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_sertifikasi') -> references('id_sertifikasi') -> on ('m_sertifikasi');
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasi_matakuliah');
    }
};
