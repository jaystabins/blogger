<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

	/**
	 * Fillable Fileds for the tag attribute
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

    /**
     * A category may have many Articles
     * 
     * @return [type] [description]
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }


    public function getCategoryListAttribute()
    {
        return $this->category->lists('name')->toArray();
    }
}
