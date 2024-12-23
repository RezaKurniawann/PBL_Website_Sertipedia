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
            $table -> unsignedBigInteger('id_vendor') -> index ;
            $table -> unsignedBigInteger('id_periode') -> index ;

            $table->string('nama');
            $table->integer('kuota');
            $table->string('lokasi');
            $table->decimal('biaya', 15, 2);
            $table->string('level_pelatihan');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->timestamps();

            $table -> foreign('id_vendor') -> references('id_vendor') -> on ('m_vendor') -> onDelete ('cascade');;
            $table -> foreign('id_periode') -> references('id_periode') -> on ('m_periode') -> onDelete ('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_pelatihan');
    }
};