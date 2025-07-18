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
        Schema::table('respondent_masters', function (Blueprint $table) {
            $table->unsignedBigInteger('shg_id')->nullable()->after('village_id');
            $table->unsignedBigInteger('pg_id')->nullable()->after('shg_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respondent_masters', function (Blueprint $table) {
            $table->dropColumn(['shg_id', 'pg_id']);
        });
    }
};
