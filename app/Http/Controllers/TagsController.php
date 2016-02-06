<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show($tag)
    {
    	$tag = \App\Tag::where('name', $tag)->first();

    	if($tag)
    	{
    		$articles = $tag->articles()->published()->paginate(5);
        	return view('articles.index', compact('articles'));
        }
        else
        {
        	abort(404);
        }
    }
}
