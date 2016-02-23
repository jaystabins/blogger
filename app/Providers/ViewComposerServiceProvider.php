<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use DB;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeSidebarPosts();
        $this->composeSidebarArchive();
        $this->composeSidebarTags();
        $this->composeBlogInfo();
        $this->composeSidebarMenuCategories();
        $this->composeNavbarMenu();
        $this->composeFooterSocialConnect();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the latest 5 articles for the Sidebar
     * @return [type] [description]
     */
    private function composeSidebarPosts()
    {
        view()->composer('partials.sidebar', function($view)
        {
            $view->with('latestPosts', \App\Article::orderBy('published_at','DESC')
                                        ->orderBy('created_at', 'DESC')
                                        ->published()
                                        ->take(5)
                                        ->get());
        });
    }

    /**
     * Get the archive or articles
     * @return [type] [description]
     */
    private function composeSidebarArchive()
    {
        view()->composer('partials.sidebar', function($view)
        {
            $view->with('archives', DB::table('articles')
                                    ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) post_count'))
                                    ->where('status', '=', '1')
                                    ->where('published_at', '<=', Carbon::now())
                                    ->groupBy('year')
                                    ->groupBy('month')
                                    ->orderBy('year', 'DESC')
                                    ->orderBy('month', 'DESC')
                                    ->get());
        });
    }

    /**
     * Get top 5 tags for blog
     */
    private function composeSidebarTags()
    {
        view()->composer('partials.sidebar', function($view)
        {
            $view->with('top5Tags', DB::table('tags')
                ->join('article_tag', 'tags.id', '=', 'article_tag.tag_id')
                ->join('articles', 'article_tag.article_id', '=', 'articles.id')
                ->select(DB::raw('tags.name, COUNT(tags.name) total'))
                ->where('articles.status', '=', '1')
                ->where('articles.published_at', '<=', Carbon::now())
                ->groupBy('tags.name')
                ->orderBy('total', 'DESC')
                ->take(5)
                ->get());
        });
    }


    /**
     * Get top 5 tags for blog
     */
    private function composeSidebarMenuCategories()
    {
        view()->composer(['partials.sidebar', 'partials.mainNav'], function($view)
        {
            $view->with('menuCategories', DB::table('categories')
                ->join('article_category', 'categories.id', '=', 'article_category.category_id')
                ->join('articles', 'articles.id', '=', 'article_category.article_id')
                ->where('add_menu', '=', '1')
                ->where('articles.status', '=', '1')
                ->where('articles.published_at', '<=', Carbon::now())
                ->groupBy('categories.id')
                ->orderBy('categories.name', 'ASC')
                ->get());
        });
    }


    /**
     * Blog info
     */
    private function composeBlogInfo()
    {
        view()->composer(['app', 'partials.footer', 'articles.index', 'articles.single', 'pages.index', 'articles.partials.articleForm', 'partials.mainNav', 'partials.metaSocialMedia'], function($view)
        {
            $view->with('info', DB::table('blog_info')
                ->first());
        });
    }

    /**
     * Navar Category info
     */
    private function composeNavbarMenu()
    {
        view()->composer(['app', 'partials.mainNav'], function($view)
        {
            $view->with('pageMenuItems', DB::table('pages')
                ->where('show_menu', '=', 1)
                ->get());
        });
    }

    /**
     * Footer Social Connect
     */
    private function composeFooterSocialConnect()
    {
        view()->composer(['app', 'partials.footer', 'articles.manage', 'partials.metaSocialMedia'], function($view)
        {
            $view->with('socialConnect', DB::table('social_connect')->first());
        });
    }
}
