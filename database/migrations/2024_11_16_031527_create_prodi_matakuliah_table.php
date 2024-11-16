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
        Schema::create('t_prodi_matakuliah', function (Blueprint $table) {
            $table->id('id_prodi_matakuliah');
            $table -> unsignedBigInteger('id_prodi') -> index;
            $table -> unsignedBigInteger('id_matakuliah') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi');
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_matakuliah');
    }
};
