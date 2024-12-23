<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_kompetensi', function (Blueprint $table) {
            $table->id('id_kompetensi');
            $table -> unsignedBigInteger('id_prodi') -> index ();
            $table->string('nama');
            $table->string('deskripsi');
            $table->timestamps();

            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi') -> onDelete ('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_kompetensi');
    }
};