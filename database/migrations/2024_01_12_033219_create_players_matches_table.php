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
        Schema::create('players_matches', function (Blueprint $table) {
            $table->id();
            $table->boolean('confirmed')->nullable();
            $table->dateTime('confirmation_date')->nullable();
            $table->string('team_name', 255)->nullable();
            $table->foreignId('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('matche_id')
                ->references('id')
                ->on('matches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players_matches');
    }
};
