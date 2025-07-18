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
        Schema::table('p_g_s', function (Blueprint $table) {
            $table->unsignedBigInteger('district_id')->nullable()->after('id');
            $table->unsignedBigInteger('block_id')->nullable()->after('district_id');
            $table->unsignedBigInteger('gram_panchyat_id')->nullable()->after('block_id');
            $table->unsignedBigInteger('village_id')->nullable()->after('gram_panchyat_id');

            $table->string('csp_name')->nullable()->after('village_id');
            $table->string('bank_account')->nullable()->after('date_of_formation');
            $table->string('branch')->nullable()->after('bank_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_g_s', function (Blueprint $table) {
            //
        });
    }
};
