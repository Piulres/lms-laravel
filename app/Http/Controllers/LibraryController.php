<?php

namespace App\Http\Controllers;

use App\Course;

class LibraryController extends Controller
{
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
        $teams = \App\Team::latest()->limit(5)->get(); 

        return view('library', compact( 'users', 'courses', 'trails', 'teams' ));
    }

}
