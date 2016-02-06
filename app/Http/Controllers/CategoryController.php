<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($category)
    {
    	$category = \App\Category::where('name', $category)->first();

    	if($category)
    	{
    		$articles = $category->articles()->published()->paginate(5);
        	return view('articles.index', compact('articles'));
        }
        else
        {
        	abort(404);
        }
    }
}
