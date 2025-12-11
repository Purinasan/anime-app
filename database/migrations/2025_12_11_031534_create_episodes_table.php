<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime')->onDelete('cascade');
            $table->integer('episode_number')->default(1);
            $table->string('title')->nullable();
            $table->string('video_144p')->nullable();
            $table->string('video_360p')->nullable();
            $table->string('video_720p')->nullable();
            $table->string('video_1080p')->nullable();
            $table->integer('duration')->nullable(); // in seconds
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episodes');
    }
};