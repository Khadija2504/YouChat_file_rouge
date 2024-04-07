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
        Schema::create('vote_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evenement_id')->constrained('evenements');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('vote', ['happy', 'heart', 'celebration', 'sad']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_events');
    }
};
