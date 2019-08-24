<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('restrict');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth')->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('status')->default(1);
            $table->string('password');
            $table->integer('audience_group_id')->unsigned()->nullable();
            $table->foreign('audience_group_id')->references('id')->on('audience_groups')->onDelete('set null');
            $table->boolean('subscribed_to_news_letter')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('audiences');
    }
}
