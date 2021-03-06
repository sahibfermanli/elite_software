<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name', '255');
            $table->smallInteger('payment_type_id'); // payment_types table
            $table->integer('payment_percent')->nullable();
            $table->integer('payment_price')->comment("with a penny (price/100)")->nullable();
            $table->integer('currency_id')->nullable(); // currencies table
            $table->boolean('is_active')->default(1);
            $table->date('start_date');
            $table->date('expiry_date')->nullable()->comment('if expiry date is null, contract is indefinite.');
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
        Schema::dropIfExists('contracts');
    }
}
