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

        /**
     * Display Course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('course_view')) {
            return abort(401);
        }
        
        $instructors = \App\User::get()->pluck('name', 'id');

        $lessons = \App\Lesson::get()->pluck('title', 'id');

        $categories = \App\Coursecategory::get()->pluck('title', 'id');
        $datacourses = \App\Datacourse::where('course_id', $id)->get();$trails = \App\Trail::whereHas('courses',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $course = Course::findOrFail($id);

        return view('admin.courses.show', compact('course', 'datacourses', 'trails'));
    }

}
