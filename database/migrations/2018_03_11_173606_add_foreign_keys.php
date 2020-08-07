<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('article_comments', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles');
        });

        Schema::table('article_images', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('article_category_id')->references('id')->on('article_categories');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('logins', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
    }
}
