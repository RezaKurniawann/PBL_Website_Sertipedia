<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_prodi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_prodi');
    }
};