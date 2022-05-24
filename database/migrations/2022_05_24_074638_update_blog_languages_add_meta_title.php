<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogLanguagesAddMetaTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('blog_languages', function (Blueprint $table) {

            $table->string('meta_title')->nullable()->after('title');

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
        Schema::table('blog_languages', function (Blueprint $table) {
            //

            $table->dropColumn('meta_title');

        });
    }
}
