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
            $table->string('nama');
            $table->string('alamat');
            $table->string('kota');
            $table->string('telepon');
            $table->string('alamatWeb');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_vendor');
    }
};