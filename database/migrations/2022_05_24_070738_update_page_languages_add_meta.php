<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePageLanguagesAddMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('page_languages', function (Blueprint $table) {
            $table->renameColumn('description', 'meta_description');
            $table->string('meta_keyword')->nullable()->after('description');

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
        Schema::table('page_languages', function (Blueprint $table) {
            //
            $table->renameColumn('meta_description', 'description');
            $table->dropColumn('meta_keyword');

        });
    }
}
