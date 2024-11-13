<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_pelatihan', function (Blueprint $table) {
            $table->id('id_pelatihan');
            $table -> unsignedBigInteger('id_matakuliah') -> index ;
            $table -> unsignedBigInteger('id_bidangminat') -> index ;
            $table -> unsignedBigInteger('id_vendor') -> index ;
            $table -> unsignedBigInteger('id_periode') -> index ;

            $table->string('nama', 100);
            $table->integer('kuota');
            $table->string('lokasi', 100);
            $table->decimal('biaya', 15, 2);
            $table->string('level_pelatihan', 50);
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('waktu_pelatihan'); // tanggal akhir - tanggal awal
            $table->timestamps();

            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat');
            $table -> foreign('id_vendor') -> references('id_vendor') -> on ('m_vendor');
            $table -> foreign('id_periode') -> references('id_periode') -> on ('m_periode');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_pelatihan');
    }
};