<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_detail_pelatihan', function (Blueprint $table) {
            $table->id('id_daftar_pelatihan');
            $table -> unsignedBigInteger('id_user') -> index ;
            $table -> unsignedBigInteger('id_pelatihan') -> index ;
            $table->string('status', 50);
            $table->string('image')->nullable();
            $table->string('surat_tugas')->nullable();
            $table->timestamps();

            $table -> foreign('id_user') -> references('id_user') -> on ('m_user');
            $table -> foreign('id_pelatihan') -> references('id_pelatihan') -> on ('m_pelatihan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_detail_pelatihan');
    }
};