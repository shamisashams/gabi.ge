<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogsTable extends Migration
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
            $table->string('meta_keywords')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
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
            $table->dropColumn('meta_keywords');
            $table->dropColumn('text_2');
            $table->dropColumn('text_3');
        });
    }
}
