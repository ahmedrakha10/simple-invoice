<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_fields', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamps();
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('field_key');
            $table->string('field_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_fields');
    }
}
