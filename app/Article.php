<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	/**
	 * Fields that are able to be mass assigned
	 */
    protected $fillable = [
    	'title',
    	'subtitle',
    	'body',
    	'excerpt',
    	'status',
    	'published_at',
        'featured_image',
    	'slug',
        'category'
    ];

    /**
     * An Article belongs to a User
     * 
     * @return Illumninate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * An Article may have many tags
     * 
     * @return Illumninate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * An Article may have one category
     * 
     * @return Illumninate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
     * Set Carbon instances for date fields
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Query Scope for all published articles after now
     * @param   $query 
     * @return  $query        
     */
    public function scopePublished($query)
    {
        $query->where('status', '=', '1')
                ->where('published_at', '<=', Carbon::now());
    }

    /**
     * Query Scope for all future published articles before now
     * @param   $query 
     * @return  $query        
     */
    public function scopeFuturepublish($query)
    {
        $query->where('status', '=', '1')
                ->where('published_at', '>=', Carbon::now());
    }

    /**
     * Query Scope for all future unpublished articles after now
     * @param   $query 
     * @return  $query        
     */
    public function scopeFutureUnpublish($query)
    {
        $query->where('status', '=', '0')
                ->where('published_at', '>=', Carbon::now());
    }

    /**
     * Query Scope for all unpublished articles
     * @param   $query 
     * @return  $query        
     */
    public function scopeMonth($query)
    {
        $query->where('status', '=', '0');
    }


    /**
     * Set Attribute for inserting date as carbon instance
     * @param  $date published_at attribute
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }


    /**
     * Set Attribute for inserting slug - Slugs should have no spaces or special charicters 
     * @param string $slug slug attribute
     */
    public function setSlugAttribute($slug)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $slug);

        $text = trim($text, '-');

        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        $text = strtolower($text);

        $text = preg_replace('~[^-\w]+~', '', $text);

        $this->attributes['slug'] = $text;
    }
}
