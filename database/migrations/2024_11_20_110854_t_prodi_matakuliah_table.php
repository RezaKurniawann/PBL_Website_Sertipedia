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
            $table -> unsignedBigInteger('id_prodi');
            $table -> unsignedBigInteger('id_matakuliah');

            $table->primary(['id_prodi', 'id_matakuliah']);

            $table->timestamps();
            
            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi') -> onDelete ('cascade') ;
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah') -> onDelete ('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_prodi_matakuliah');
    }
};