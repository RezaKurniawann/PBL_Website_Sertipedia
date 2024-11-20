<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('id_user');
            $table -> unsignedBigInteger('id_level') -> index;
            $table -> unsignedBigInteger('id_prodi') -> index;
            $table -> unsignedBigInteger('id_pangkat') -> index;
            $table -> unsignedBigInteger('id_golongan') -> index;
            $table -> unsignedBigInteger('id_jabatan') -> index;
            $table->string('nama');
            $table->string('email');
            $table->string('no_telp');
            $table->string('username') -> unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->timestamps();

            $table -> foreign('id_level') -> references('id_level') -> on ('m_level');
            $table -> foreign('id_pangkat') -> references('id_pangkat') -> on ('m_pangkat');
            $table -> foreign('id_jabatan') -> references('id_jabatan') -> on ('m_jabatan');
            $table -> foreign('id_golongan') -> references('id_golongan') -> on ('m_golongan');
            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_user');
    }
};