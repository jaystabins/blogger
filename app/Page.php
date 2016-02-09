<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	/**
	 * Fields that are able to be mass assigned
	 */
    protected $fillable = [
    	'title',
    	'body',
    	'show_sidebar',
    	'show_menu',
        'show_contact_form',
    	'slug'
    ];

}
