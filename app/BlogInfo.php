<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BlogInfo extends Model
{

    protected $table = "blog_info";
	/**
	 * Fields that are able to be mass assigned
	 */
    protected $fillable = [
            'blog_name',
            'tagline',
            'author',
            'email',
            'featured_image',
            'auto_category_menu',
            'disqus_shortname',
            'category_navbar'
            ];

}