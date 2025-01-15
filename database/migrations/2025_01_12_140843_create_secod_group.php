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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['depositar', 'retirar']);
            $table->float('value');
            $table->enum('status', ['pendente', 'processando', 'concluido', 'rejeitado'])->default('pendente');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });

        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->text('token');
            $table->decimal('value');
            $table->enum('status', ['unused', 'used'])->default('unused');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value');
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
        Schema::dropIfExists('gifts');
        Schema::dropIfExists('transactions');
    }
};
