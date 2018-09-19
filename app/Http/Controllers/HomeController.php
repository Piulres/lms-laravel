<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = \App\User::latest()->limit(5)->get(); 
        $courses = \App\Course::latest()->limit(5)->get(); 
        $trails = \App\Trail::latest()->limit(5)->get(); 
        $faqquestions = \App\FaqQuestion::latest()->limit(5)->get(); 

        return view('index', compact( 'users', 'courses', 'trails', 'faqquestions' ));
    }

    public function home()
    {
        
        $users = \App\User::latest()->limit(5)->get(); 
        $courses = \App\Course::latest()->limit(5)->get(); 
        $trails = \App\Trail::latest()->limit(5)->get(); 
        $faqquestions = \App\FaqQuestion::latest()->limit(5)->get(); 

        return view('home', compact( 'users', 'courses', 'trails', 'faqquestions' ));
    }
}
