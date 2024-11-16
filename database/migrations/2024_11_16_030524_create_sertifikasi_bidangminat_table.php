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
        Schema::create('t_sertifikasi_bidangminat', function (Blueprint $table) {
            $table->id('id_sertifikasi_bidangminat');
            $table -> unsignedBigInteger('id_sertifikasi') -> index;
            $table -> unsignedBigInteger('id_bidangminat') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_sertifikasi') -> references('id_sertifikasi') -> on ('m_sertifikasi');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasi_bidangminat');
    }
};
