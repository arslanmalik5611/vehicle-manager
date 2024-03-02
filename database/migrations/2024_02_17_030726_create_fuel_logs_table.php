<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id');
            $table->date('fill_up_date')->nullable();
            $table->decimal('us_gallons')->nullable();
            $table->decimal('total_cost')->nullable();
            $table->string('odometer_unit')->nullable();
            $table->decimal('starting_odometer')->nullable();
            $table->decimal('ending_odometer')->nullable();
            $table->decimal('odometer_changes')->nullable();
            $table->decimal('us_mpg')->nullable();
            $table->text('notes')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('fuel_logs');
    }
}
