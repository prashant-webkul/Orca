<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudienceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audience_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audience_id')->unsigned();
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('cascade');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('postcode');
            $table->string('phone');
            $table->boolean('default_address')->default(0);
            $table->string('name')->nullable();
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
        Schema::dropIfExists('audience_addresses');
    }
}
