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
<<<<<<< HEAD
            $table->string('nama', 100);
            $table->string('username')->unique();
            $table->string('password', 255);
=======
            $table->string('nama');
            $table->string('email');
            $table->string('no_telp');
            $table->string('username') -> unique();
            $table->string('password');
>>>>>>> e48c2070138225d065b1b223674919b59f8f6c55
            $table->string('image')->nullable();
            $table->timestamps();

            $table -> foreign('id_level') -> references('id_level') -> on ('m_level');
            $table -> foreign('id_prodi') -> references('id_prodi') -> on ('t_prodi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_user');
    }
};