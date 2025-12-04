<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->string('opening_url')->nullable()->after('video_url');
        });
    }

    public function down()
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->dropColumn('opening_url');
        });
    }
};