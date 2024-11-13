<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table -> unsignedBigInteger('id_level') -> index;
            $table->string('nama', 100);
            $table->integer('username')->unique();
            $table->string('password', 255);
            $table->string('image')->nullable();
            $table->timestamps();

            $table -> foreign('id_level') -> references('id_level') -> on ('m_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
