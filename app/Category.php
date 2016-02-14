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

    public static function getCategoryByArticle($article_id)
    {
        $category = Category::join('article_category', 'categories.id', '=', 'article_category.category_id')
                    ->join('articles', 'articles.id', '=', 'article_category.article_id')
                    ->where('articles.id', '=', $article_id)
                    ->first();
        return $category;
    }

    public static function setCategoryMenu($category_id, $add_menu)
    {
        $category = Category::where('id', '=', $category_id)->first();
        $category->add_menu = $add_menu;
        $category->save();
    }
}
