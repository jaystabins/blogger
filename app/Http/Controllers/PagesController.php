<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
	/**
	 * Home page route
	 * 
	 * @return [type] [description]
	 */
	public function home(){
		return view('pages/home');
	}

	/**
	 *  About Page route
	 *  
	 * @return [type] [description]
	 */
    public function about(){
    	return view('pages/about');
    }

    /**
     * Contact Page route
     * 			
     * @return [type] [description]
     */
    public function contact(){
    	return view('pages/contact');
    }
}

