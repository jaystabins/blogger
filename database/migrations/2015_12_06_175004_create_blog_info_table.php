<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('blog_name');
            $table->string('tagline');
            $table->string('author');
            $table->string('email');
            $table->boolean('auto_category_menu');
            $table->boolean('category_navbar');
            $table->string('featured_image');
            $table->string('disqus_shortname');
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
        Schema::drop('blog_info');
    }
}
