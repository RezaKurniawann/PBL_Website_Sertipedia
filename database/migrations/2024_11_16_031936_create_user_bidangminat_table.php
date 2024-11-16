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
        Schema::create('t_user_bidangminat', function (Blueprint $table) {
            $table->id('id_user_bidangminat');
            $table -> unsignedBigInteger('id_user') -> index;
            $table -> unsignedBigInteger('id_bidangminat') -> index ;
            $table->timestamps();
            
            $table -> foreign('id_user') -> references('id_user') -> on ('m_user');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bidangminat');
    }
};
