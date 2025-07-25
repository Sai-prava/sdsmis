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
        Schema::create('s_h_g_s', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('code')->nullable();
            $table->date('date_of_formation')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('gram_panchyat_id')->nullable();
            $table->integer('village_id')->nullable();
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
        Schema::dropIfExists('s_h_g_s');
    }
};
