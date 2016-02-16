<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

use App\Page;
use App\MailSetting;
use DB;

use Config;
use Mail;
use Swift_Mailer;
use Swift_SmtpTransport;

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

    	return redirect($page->slug);
    }

    public function sendContactMail(Request $request)
    {
    	$mail = DB::table('mail_settings')->first();

    	$config = array(
    		'driver' => $mail->driver,
	        'host' => $mail->host,
	        'port' => $mail->port,
	        'from' => array('address' => $mail->from_address, 'name' => $mail->from_name),
	        'encryption' => $mail->encryption,
	        'username' => $mail->username,
	        'password' => MailSetting::getPasswordAttribute($mail->password),
	        'sendmail' => '/usr/sbin/sendmail -bs',
	        'pretend' => false
        );

	    Config::set('mail',$config);

	    // extract config
	    extract(Config::get('mail'));

	    // create new mailer with new settings
	    $transport = Swift_SmtpTransport::newInstance($host, $port);
	    // set encryption
	    if (isset($encryption)) $transport->setEncryption($encryption);
	    // set username and password
	    if (isset($username))
	    {
	        $transport->setUsername($username);
	        $transport->setPassword($password);
	    }
	    // set new swift mailer
	    Mail::setSwiftMailer(new Swift_Mailer($transport));
	    // set from name and address
	    if (is_array($from) && isset($from['address']))
	    {
	        Mail::alwaysFrom($from['address'], $from['name']);
	    }

    	$sent = Mail::send('emails.contact', $request->all(), function($message) use ($config)
		{
			$message->to($config['from']['address'])->subject('New Blog Message From : ' . $config['from']['name']);
		});	

		if(!$sent)
            abort(503);

        alert()->success('Your email has been delivered', 'Success!');

		return redirect('/');
	}

}

