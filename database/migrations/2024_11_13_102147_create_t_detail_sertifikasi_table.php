<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_detail_sertifikasi', function (Blueprint $table) {

            $table -> unsignedBigInteger('id_user');
            $table -> unsignedBigInteger('id_sertifikasi');

            $table->primary(['id_user', 'id_sertifikasi']);
   
            $table->string('status', 50);
            $table->string('no_sertifikasi', 50) -> nullable();
            $table->string('image')->nullable();
            $table->string('surat_tugas')->nullable();
            $table->timestamps();

            $table -> foreign('id_user') -> references('id_user') -> on ('m_user')  -> onDelete ('cascade');
            $table -> foreign('id_sertifikasi') -> references('id_sertifikasi') -> on ('m_sertifikasi')  -> onDelete ('cascade');
     
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_detail_sertifikasi');
    }
};