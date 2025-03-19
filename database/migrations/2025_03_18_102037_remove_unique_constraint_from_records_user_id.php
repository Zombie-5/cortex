<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            // Primeiro, remove a chave estrangeira
            $table->dropForeign(['user_id']);

            // Depois, remove a restrição UNIQUE
            $table->dropUnique('records_user_id_unique');

            // Por fim, adiciona novamente a chave estrangeira sem a restrição UNIQUE
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            // Remove a chave estrangeira para evitar conflito
            $table->dropForeign(['user_id']);

            // Reaplica a restrição UNIQUE
            $table->unique('user_id');

            // Adiciona novamente a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
