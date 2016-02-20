<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Illuminate\Http\Request;
use DB;

class ArticleController extends Controller
{
    /**
     * Create a new instance of the ArticleController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'showMonth', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!\App\BlogInfo::first())
        {
            return redirect('/install');
        }

        $articles = Article::orderBy('published_at','DESC')
                                ->orderBy('created_at', 'DESC')
                                ->published()
                                ->paginate(5);
        
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tag_list = Tag::lists('name', 'id');
        $category_list = Category::lists('name', 'id');

        return view('articles.create', compact('tag_list', 'category_list'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArticleRequest  $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        //Create a new article and save it with the relationship built in the model
        $article = \Auth::user()->articles()->create($request->all());
        
        $excerpt = substr(preg_replace("/<img[^>]+\>/i", "(image) ", $article->body), 0, 200);
        $article->excerpt = $excerpt;
        $article->save();

        $this->syncTags($article, (array) $request->input('tag_list'));
        $this->syncCategories($article, (array) $request->input('category_list'));

        $category = Category::getCategoryByArticle($article->id);

        if(!is_null($category))
        {
            $info = DB::table('blog_info')->first();

            $addMenu = $request->auto_category_menu == 'on' ? 1 : 0;

            Category::setCategoryMenu($category->category_id, $addMenu);
        }

        alert()->success('Post Created Successfully!', 'Success!');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', '=', $slug)->published()->first();
        $blog_info = \App\BlogInfo::first();

        if( ! $article )
            abort(404);

        return view('articles.single', compact('article', 'blog_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $article = Article::where('slug', '=', $slug)->first();

        $category_list = Category::lists('name', 'id');
        $tag_list = Tag::lists('name', 'id');

        if( ! $article )
            abort(404);

        return view('articles.edit', compact('article', 'tag_list', 'category_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ArticleRequest $request, $slug)
    {
        $article = Article::findOrFail($request->id);
        $article->update($request->all());

        $excerpt = substr(preg_replace("/<img[^>]+\>/i", "(image) ", $article->body), 0, 200);
        $article->excerpt = $excerpt;
        $article->save();

        $this->syncTags($article, (array) $request->input('tag_list'));
        $this->syncCategories($article, (array) $request->input('category_list'));

        //fetch new article based on updated slug
        //todo: probably rethink this logic add some helper function to update slug or remove from model
        $article = Article::findOrFail($request->id);

        $category = Category::getCategoryByArticle($article->id);

        if(!is_null($category))
        {
            $info = DB::table('blog_info')->first();

            $addMenu = $request->auto_category_menu == 'on' ? 1 : 0;

            Category::setCategoryMenu($category->category_id, $addMenu);
        }

        alert()->success('Post has been updated!', 'Success!');

        return redirect(route('blog.show', ['slug' => $article->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $article = Article::where('slug', '=', $request->slug)->first();

        if( ! $article )
            abort(404);

        $article->delete();

        alert()->success('Post Has Been Deleted!', 'Success!');

        return redirect('/');
    }

    /**
     * Show posts in a given month and year
     *
     * @param int $year Year to show
     * @param int $month Month of the year to show
     */
    public function showMonth($year, $month)
    {
        $articles = Article::whereYear('published_at', '=', $year)
                            ->whereMonth('published_at', '=', $month)
                            ->published()
                            ->orderBy('published_at', 'DESC')
                            ->paginate(5);

        if( ! $articles )
            abort(404);

        return view('articles.index', compact('articles'));
    }

    /**
     * Search blog for keyword
     *
     * @param string $search term to search for
     */
    public function search(Request $request)
    {
        $articles = Article::join('article_tag', 'articles.id', '=', 'article_tag.article_id')
                        ->join('tags', 'tags.id', '=', 'article_tag.tag_id')
                        ->join('article_category', 'articles.id', '=', 'article_category.article_id')
                        ->join('categories', 'categories.id', '=', 'article_category.category_id')
                        ->where('title', 'LIKE', "%$request->term%")
                        ->orWhere('subtitle', 'LIKE', "%$request->term%")
                        ->orWhere('body', 'LIKE', "%$request->term%")
                        ->orWhere('slug', 'LIKE', "%$request->term%")
                        ->orWhere('tags.name', 'LIKE', "%$request->term%")
                        ->orWhere('categories.name', 'LIKE', "%$request->term%")
                        ->groupBy('articles.slug')
                        ->published()
                        ->paginate(5);

        if( $articles->isEmpty() )
            abort(404);

        return view('articles.index', compact('articles'));
    }

    /**
     * Sync tags for the given article in pivot table
     * @param  Article $article Article to sync tags
     * @param  array   $tags    Tags to sync
     * @return null           
     */
    private function syncTags(Article $article, array $tags)
    {
        $checkedTags = $this->checkTags($tags);
        $article->tags()->sync($checkedTags);
    }


    /**
     * Check if tag exists, if not create them
     * @param  array  $tags list of all tags including new ones
     * @return array       aray of all tags, new and old
     */
    private function checkTags(array $tags)
    {
        $currentTags = array_filter($tags, 'is_numeric');
        $newTags = array_diff($tags, $currentTags);

        foreach ($newTags as $newTag) 
        {
            if($tag = Tag::create(['name' => $newTag]))
            {
                $currentTags[] = $tag->id;
            }
        }

        return $currentTags;
    }

    /**
     * Sync category for the given article in pivot table
     * @param  Article $article Article to sync tags
     * @param  array   $tags    Tags to sync
     * @return null           
     */
    private function syncCategories(Article $article, array $categories)
    {
        $checkedCategoires = $this->checkCategories($categories);
        $article->categories()->sync($checkedCategoires);
    }


    /**
     * Check if tag exists, if not create them
     * @param  array  $tags list of all tags including new ones
     * @return array       aray of all tags, new and old
     */
    private function checkCategories(array $categories)
    {
        $currentCategories = array_filter($categories, 'is_numeric');
        $newCategories = array_diff($categories, $currentCategories);

        foreach ($newCategories as $newCategory) 
        {
            if($category = Category::create(['name' => $newCategory]))
            {
                $currentCategories[] = $category->id;
            }
        }

        return $currentCategories;
    }
}
