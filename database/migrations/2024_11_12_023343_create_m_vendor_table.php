<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_vendor', function (Blueprint $table) {
            $table->id('id_vendor');
            $table->string('nama', 100);
            $table->string('alamat', 100);
            $table->string('kota', 100);
            $table->string('telepon', 15);
            $table->string('alamatWeb', 255);
            $table->string('kategori', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_vendor');
    }
};