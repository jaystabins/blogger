<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

use App\Page;

class PagesController extends Controller
{
	/**
	 * Home page route
	 * 
	 * @return [type] [description]
	 */
	public function index($slug){
		$page = Page::where('slug', '=', $slug)->first();

		if( ! $page )
			abort(404);

		return view('pages.index', compact('page'));
	}

	public function create()
	{
		return view('pages.create');
	}

	public function store(PageRequest $request)
	{
        $page = Page::create($request->all());

		return view('pages.index', compact('page'));
	}

	public function edit($slug)
	{
		$page = Page::where('slug', '=', $slug)->first();

		return view('pages.edit', compact('page'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $page = Page::where('id', '=', $request->id)->first();

        if( ! $page )
            abort(404);

        $page->delete();

        return redirect('/');
    }

    public function update(PageRequest $request)
    {
    	$page = Page::where('slug', '=', $request->slug)->first();

    	$page->update($request->all());

    	$page->save();

    	return redirect($page->slug);
    }

}

