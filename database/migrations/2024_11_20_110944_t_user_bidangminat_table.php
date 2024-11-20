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
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_bidangminat');

            $table->primary(['id_user', 'id_bidangminat']);

            $table->timestamps();
            
            $table -> foreign('id_user') -> references('id_user') -> on ('m_user') -> onDelete ('cascade');
            $table -> foreign('id_bidangminat') -> references('id_bidangminat') -> on ('m_bidangminat')-> onDelete ('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_user_bidangminat');
    }
};