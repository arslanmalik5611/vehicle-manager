<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('number')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('vendor_id')->nullable();
            $table->decimal('price')->nullable();
            $table->foreignId('material_type_id')->nullable();
            $table->decimal('quantity')->nullable();
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
        Schema::dropIfExists('materials');
    }
}
