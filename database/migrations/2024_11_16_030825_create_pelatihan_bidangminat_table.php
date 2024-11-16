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
        Schema::create('t_pelatihan_bidangminat', function (Blueprint $table) {
            $table->id('id_pelatihan_bidangminat');
            $table -> unsignedBigInteger('id_pelatihan') -> index;
            $table -> unsignedBigInteger('id_bidangminat') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_pelatihan') -> references('id_pelatihan') -> on ('m_pelatihan');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_bidangminat');
    }
};
