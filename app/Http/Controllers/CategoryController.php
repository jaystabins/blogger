<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
    public function show($category)
    {
    	$category = Category::where('name', $category)->first();

    	if(!$category)
            abort(404);

		$articles = $category->articles()->published()->paginate(5);
    	return view('articles.index', compact('articles'));
    }

    public function checkCategory(Request $request)
    {
        $category = Category::where('id', $request->id)->first();

        if($category)
        {
            return $category->add_menu;
        }

        return 'New Category';
    }
    
    public function updateCategory(Request $request)
    {
        $category = \App\Category::where('id', '=', $request->id)->first();
        $category->add_menu = $request->checked;
        $category->name = $request->name;
        $category->save();

        return 'success';
    }
}
