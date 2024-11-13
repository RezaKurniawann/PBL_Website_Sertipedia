<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('id_user');
            $table -> unsignedBigInteger('id_level') -> index;
            $table -> unsignedBigInteger('id_matakuliah') -> index;
            $table -> unsignedBigInteger('id_bidangminat') -> index;
            $table -> unsignedBigInteger('id_prodi') -> index;
            $table->string('nama', 100);
            $table->integer('username')->unique();
            $table->string('password', 255);
            $table->string('image')->nullable();
            $table->timestamps();

            $table -> foreign('id_level') -> references('id_level') -> on ('m_level');
            $table -> foreign('id_matakuliah') -> references('id_matakuliah') -> on ('m_matakuliah');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat');
            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_user');
    }
};