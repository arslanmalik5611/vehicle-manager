<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleMechanicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_mechanicals', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('transmission')->nullable();
            $table->string('tire_size')->nullable();
            $table->string('engine')->nullable();
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
        Schema::dropIfExists('vehicle_mechanicals');
    }
}
