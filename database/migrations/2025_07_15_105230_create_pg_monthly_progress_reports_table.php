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
        Schema::create('pg_monthly_progress_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pg_id')->nullable();
            $table->string('month')->nullable();                      // e.g.,
            $table->string('year')->nullable();                      // e.g.,
            $table->string('meeting_held')->nullable();               // "yes" or "no"
            $table->string('member_presence_percent')->nullable();   // % of members present
            $table->string('input_sale_amount')->nullable();         // Rs. A
            $table->string('output_sale_amount')->nullable(); 
            $table->string('total_sales')->nullable();       // Rs. B             // A + B
            $table->string('loan_taken')->nullable();                // Rs. loan taken
            $table->string('loan_returned')->nullable();             // Rs. returned
            $table->string('interest_paid')->nullable(); 
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
        Schema::dropIfExists('pg_monthly_progress_reports');
    }
};
