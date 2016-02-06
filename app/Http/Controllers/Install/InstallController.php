<?php

namespace App\Http\Controllers\Install;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Http\Requests\RegistrationRequest;

use Response;

use App\Article;
use App\BlogInfo;
use App\Category;
use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstallController extends Controller
{
    /**
     * Create a new instance of the ManageController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['installRegister', 'installBlogShow']]);
    }

    /**
     * Shows the inital install page
     * 
     * @return [view] Insaller view
     */
    public function installBlogShow()
    {
        $user = User::first();

        if($user && !Auth::check())
        {
            return view('Install.installLogin');
        }
        elseif($user && Auth::check())
        {
            return view('Install.installManage');
        }

        return view('Install.installRegister');
    }

    /**
     * Logs in a specific user during registration process
     * @return view 
     */
    public function installRegister(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if(Auth::attempt(['email' => $user->email, 'password' => $request->input('password')]))
        {
            return redirect('install');
        }
    }

    public function installManage(SettingsRequest $request)
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
}
