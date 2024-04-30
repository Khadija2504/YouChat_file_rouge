<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->text('about')->nullable();
            $table->string('contry')->nullable();
            $table->string('city')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('ban')->default(false);
            $table->enum('status', ['active', 'inactive', 'invisible', 'disabled'])->default('active');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->enum('acceptation', ['auto', 'manuelle'])->default('auto');
            $table->string('password')->nullable();
            $table->string('social_id')->nullable();
            $table->string('google_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
