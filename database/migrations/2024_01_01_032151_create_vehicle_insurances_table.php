<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            // $table->foreignId('vehicle_id')->constrained();
            $table->string('company')->nullable();
            $table->string('account_no')->nullable();
            $table->string('premium')->nullable();
            $table->date('due')->nullable();
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
        Schema::dropIfExists('vehicle_insurances');
    }
}
