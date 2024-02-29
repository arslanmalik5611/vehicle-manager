<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('material_type_id')->nullable();
            $table->integer('is_repeat')->nullable();
            $table->integer('repeat_times')->nullable();
            $table->string('repeat_type')->nullable();
            $table->integer('repeat_odometer_units')->nullable();
            $table->integer('show_reminder_times')->nullable();
            $table->string('reminder_type')->nullable();
            $table->string('reminder_odometer_units')->nullable();
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
        Schema::dropIfExists('service_items');
    }
}
