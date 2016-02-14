<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialConnectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_connect', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('facebook_active');
            $table->string('facebook_url');
            $table->boolean('youtube_active');
            $table->string('youtube_url');
            $table->boolean('twitter_active');
            $table->string('twitter_url');
            $table->boolean('googlePlus_active');
            $table->string('googlePlus_url');
            $table->boolean('linkedin_active');
            $table->string('linkedin_url');
            $table->boolean('pinterest_active');
            $table->string('pinterest_url');
            $table->boolean('instagram_active');
            $table->string('instagram_url');
            $table->boolean('github_active');
            $table->string('github_url');
            $table->boolean('rss_active');
            $table->string('rss_url');
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
        Schema::drop('social_connect');
    }
}
