<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShippingColumnInProductLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_languages', function (Blueprint $table) {
            $table->text('short_description')->change();
            $table->text('shipping')->nullable()->after("short_description");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_languages', function (Blueprint $table) {
            $table->string('short_description')->change();
            $table->dropColumn('shipping');
        });
    }
}
