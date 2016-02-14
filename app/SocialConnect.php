<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialConnect extends Model
{

      protected $table = "social_connect";
	/**
	 * Fillable Fileds for the SocialShare attribute
	 * @var array
	 */
	protected $fillable = [
            'facebook_active',
            'facebook_url',
            'youtube_active',
            'youtube_url',
            'twitter_active',
            'twitter_url',
            'googlePlus_active',
            'googlePlus_url',
            'linkedin_active',
            'linkedin_url',
            'pintrest_active',
            'pintrest_url',
            'instagram_active',
            'instagram_url',
            'github_active',
            'github_url',
            'rss_active',
            'rss_url'
	];
}
