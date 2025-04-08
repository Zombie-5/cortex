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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('tel')->unique();
            $table->string('name')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });

        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->float('money')->default(0);
            $table->float('today')->default(0);
            $table->float('daily')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner');
            $table->string('iban')->unique();
            $table->boolean('is_admin')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->float('price');
            $table->float('income');
            $table->integer('duration');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_displayed')->default(false);
            $table->timestamps();
        });

        Schema::create('product_users', function (Blueprint $table) {
            $table->id();
            $table->float('income_total')->default(0);
            $table->timestamp('last_collection')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_users');
        Schema::dropIfExists('products');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('users');
    }
};
