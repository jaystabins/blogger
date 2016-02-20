<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

use App\Page;
use App\MailSetting;
use App\User;

use Mail;

class PagesController extends Controller
{
    /**
     * Create a new instance of the ManageController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }


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

	/**
	 * Show the page create form
	 * 
	 * @return [type] [description]
	 */
	public function create()
	{
		return view('pages.create');
	}

	/**
	 * Store the resource for the new page
	 * 
	 * @param  PageRequest $request 
	 * @return View               show the index page
	 */
	public function store(PageRequest $request)
	{
        $page = Page::create($request->all());

        alert()->success('Page has been created!', 'Success!');

		return view('pages.index', compact('page'));
	}

	/**
	 * Show the Edit page for given Page
	 * 
	 * @param  string $slug slug for page
	 * @return view       
	 */
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
        $page = Page::where('slug', '=', $request->slug)->first();

        if( ! $page )
            abort(404);

        $page->delete();

        alert()->success('Page Has Been Deleted!', 'Success!');

        return redirect('/');
    }

    /**
     * Update page post request
     * @param  PageRequest $request 
     * @return ridirect               
     */
    public function update(PageRequest $request)
    {
    	$page = Page::where('slug', '=', $request->slug)->first();

    	$page->update($request->all());

    	$page->save();

    	alert()->success('Page has been updated!', 'Success!');

    	return redirect($page->slug);
    }

    public function sendContactMail(Request $request)
    {
	    $m = MailSetting::first();

    	$sent = Mail::send('emails.contact', $request->all(), function($message) use ($m)
		{
			$message->to($m->from_address, $m->from_name)->subject('New Blog Message From : ' . $m->from_name);
		});	

		if(!$sent)
		{
			alert()->error('There was a problem sending your mail, please try again', 'Error!');
            return redirect()->back()->withInput();
        }

        alert()->success('Your email has been delivered', 'Success!');

		return redirect('/');
	}

}

