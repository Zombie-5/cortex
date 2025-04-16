<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->text('notice');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('carrossel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrossel');
        Schema::dropIfExists('notices');
    }
};
