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
            $table -> unsignedBigInteger('id_sertifikasi');
            $table -> unsignedBigInteger('id_bidangminat');

            $table->primary(['id_sertifikasi', 'id_bidangminat']);

            $table->timestamps();
            
            $table -> foreign('id_sertifikasi') -> references('id_sertifikasi') -> on ('m_sertifikasi') -> onDelete ('cascade');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat') -> onDelete ('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sertifikasi_bidangminat');
    }
};