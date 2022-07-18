<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddressesTableAddCountryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('addresses', function (Blueprint $table) {

            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            //$table->foreign('country_id')->references('id')->on('countries');
            //$table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('addresses', function (Blueprint $table) {
            //

            $table->dropColumn('country_id');
            $table->dropColumn('city_id');


        });
    }
}
