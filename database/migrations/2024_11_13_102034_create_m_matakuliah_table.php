<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_matakuliah', function (Blueprint $table) {
            $table->id('id_matakuliah');
            $table->string('nama');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('m_matakuliah');
    }
};