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
        Schema::create('t_pelatihan_matakuliah', function (Blueprint $table) {
            $table -> unsignedBigInteger('id_pelatihan');
            $table -> unsignedBigInteger('id_matakuliah');

            $table->primary(['id_pelatihan', 'id_matakuliah']);

            $table->timestamps();
            
            $table -> foreign('id_pelatihan') -> references('id_pelatihan') -> on ('m_pelatihan') -> onDelete ('cascade');
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah') -> onDelete ('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pelatihan_matakuliah');
    }
};