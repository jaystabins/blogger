<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	/**
	 * Fillable Fileds for the tag attribute
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	 /**
     * Get the articles associated with the given tag.
     * 
     * @return Illumninate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
    	return $this->belongsToMany('App\Article');
    }

    public function getTagListAttribute()
    {
    	return $this->tags->lists('id')->toArray();
    }
}
