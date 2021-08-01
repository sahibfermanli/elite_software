<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('locations');

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('area_id'); // location_areas table
            $table->integer('activity_id'); // location_activities table
            $table->smallInteger('payment_type_id'); // payment_types table
            $table->integer('payment_percent')->nullable();
            $table->integer('payment_price')->comment("with a penny (price*100)")->nullable();
            $table->integer('currency_id')->nullable(); // currencies table
            $table->integer('contract_id')->nullable(); // contracts table
            // default
            $table->boolean('created_by')->nullable();
            $table->boolean('updated_by')->nullable();
            $table->boolean('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
