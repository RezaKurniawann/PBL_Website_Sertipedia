<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_bidangminat', function (Blueprint $table) {
            $table->id('id_bidangminat');
            $table->string('kode', 10);
            $table->string('nama', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_bidangminat');
    }
};
