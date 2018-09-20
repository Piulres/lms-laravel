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
        $courses = \App\Course::latest()->get();
        return view('library', compact( 'courses' ));
    }

}
