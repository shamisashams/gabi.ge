<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeguidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizeguides', function (Blueprint $table) {
            $table->id();
            // $table->text('age')->nullable();
            $table->text('chest')->nullable();
            $table->text('wheist')->nullable();
            $table->text('hips')->nullable();
            $table->text('back')->nullable();
            $table->text('arm')->nullable();
            $table->text('leg')->nullable();
            $table->text('shoulder')->nullable();
            $table->boolean('gender')->default(true)->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('sizeguides');
    }
}
