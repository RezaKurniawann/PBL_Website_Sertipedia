<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_detail_sertifikasi', function (Blueprint $table) {
            $table->id('id_detail_sertifikasi');
            $table -> unsignedBigInteger('id_user') -> index ;
            $table -> unsignedBigInteger('id_sertifikasi') -> index;
            $table->string('status', 50);
            $table->string('no_sertifikasi', 50) -> nullable();
            $table->string('image')->nullable();
            $table->string('surat_tugas')->nullable();
            $table->timestamps();

            $table -> foreign('id_user') -> references('id_user') -> on ('m_user');
            $table -> foreign('id_sertifikasi') -> references('id_sertifikasi') -> on ('m_sertifikasi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_detail_sertifikasi');
    }
};