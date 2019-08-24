<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVerifiedColumnInAudiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audiences', function (Blueprint $table) {
            $table->boolean('is_verified')->default(0)->after('subscribed_to_news_letter');
            $table->string('token')->nullable()->after('is_verified');
            $table->dropColumn('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audiences', function (Blueprint $table) {
            $table->dropColumn('is_verified');
            $table->dropColumn('token');
            $table->enum('gender', ['Male', 'Female'])->after('last_name');
        });
    }
}