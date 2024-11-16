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
        Schema::create('t_user_matakuliah', function (Blueprint $table) {
            $table->id('id_user_matakuliah');
            $table -> unsignedBigInteger('id_user') -> index;
            $table -> unsignedBigInteger('id_matakuliah') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_user') -> references('id_user') -> on ('m_user');
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_matakuliah');
    }
};