<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Http\Requests\RegistrationRequest;

use Response;

use App\Article;
use Auth;
use App\User;
use App\BlogInfo;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{

    /**
     * Create a new instance of the ManageController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['installRegister', 'installBlog', 'installBlogShow']]);
    }

    /**
     * Shows the inital install page
     * 
     * @return [view] Insaller view
     */
    public function installBlogShow()
    {
        return view('manage.install');
    }

    /**
     * Manage all posts
     * 
     */
    public function manageArticles()
    {
        $articles = Article::get();
        $blog_info = BlogInfo::first();
        $categories = Category::get();

        return view('articles.manage', compact('articles', 'blog_info', 'categories'));
    }

    /**
     * Creates User for inital blog install
     * @param  RegistrationRequest $request [A validated Request]
     * @return [type]                       [json response or a view instance]
     */
    public function installRegister(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if($request->ajax() && Auth::attempt(['email' => $user->email, 'password' => $request->input('password')]))
        {
            return Response::json([
                'success' => true,
                'userName' => $user->name
            ], '200');
        }
        elseif($request->ajax())
        {
            return Response::json([
                'success' => false,
                'error' => 'Problem logging in, please try again'
            ], '500');
        }

        return view('');
    }

    /**
     * Stores the blog info for the blog
     * 
     */
    public function storeBlogInfo(Request $request)
    {
    	$blog_info = BlogInfo::first();
    	$articles = Article::get();
        $categories = Category::get();

    	if(!$blog_info)
    	{
    		$blog_info = BlogInfo::create($request->all());
    	}
    	else
    	{
    		$blog_info->update($request->all());
    	}

        return view('articles.manage', compact('articles', 'blog_info', 'categories'));
    }

    public function updateCategory(Request $request)
    {
        $category = \App\Category::where('id', '=', $request->id)->first();
        $category->add_menu = $request->checked;
        $category->save();

        return 'success';
    }
}
