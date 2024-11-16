<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_detail_pelatihan', function (Blueprint $table) {

            $table -> unsignedBigInteger('id_user');
            $table -> unsignedBigInteger('id_pelatihan');

            $table->primary(['id_user', 'id_pelatihan']);

            $table->string('status', 50);
            $table->string('image')->nullable();
            $table->string('surat_tugas')->nullable();
            $table->timestamps();

            $table -> foreign('id_user') -> references('id_user') -> on ('m_user')  -> onDelete ('cascade');
            $table -> foreign('id_pelatihan') -> references('id_pelatihan') -> on ('m_pelatihan')  -> onDelete ('cascade');
  
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_detail_pelatihan');
    }
};