<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id');
            $table->foreignId('service_item_id')->constrained();
            $table->integer('is_repeat')->nullable();
            $table->integer('repeat_times')->nullable();
            $table->string('repeat_type')->nullable();
            $table->integer('repeat_odometer_units')->nullable();

            $table->integer('show_reminder')->nullable();
            $table->string('reminder_type')->nullable();
            $table->string('reminder_odometer_units')->nullable();

            $table->date('next_due_date')->nullable();
            $table->date('next_due_miles')->nullable();
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
        Schema::dropIfExists('service_schedules');
    }
}
