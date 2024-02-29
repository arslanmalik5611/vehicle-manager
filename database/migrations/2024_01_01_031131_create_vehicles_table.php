<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->year('model_year')->nullable();
            $table->integer('odo_meter')->nullable();
            $table->string('odometer_unit')->nullable();
            $table->string('make')->nullable();
            $table->bigInteger('vin_no')->nullable();
            $table->string('model')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('color')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained();
            $table->foreignId('vehicle_type_id')->nullable()->constrained();
            $table->string('image')->nullable();
            $table->foreignId('department_id')->nullable()->constrained();
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
        Schema::dropIfExists('vehicles');
    }
}
