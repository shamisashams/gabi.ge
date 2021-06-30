<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentColumnsInPageLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_languages', function (Blueprint $table) {
            $table->text('content_4')->after('content')->nullable();
            $table->text('content_3')->after('content')->nullable();
            $table->text('content_2')->after('content')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_languages', function (Blueprint $table) {
            $table->dropColumn('content_2');
            $table->dropColumn('content_3');
            $table->dropColumn('content_4');
        });
    }
}
