<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursesRequest;
use App\Http\Requests\Admin\UpdateCoursesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

        // $courses = DB::table('courses')
        // ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
        // ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
        // ->get();

        //        dd($courses);
        
        if (Auth::check()) {
        
            if 
                (! Gate::allows('course_access')) {
                return redirect('login');
            }

            $user = Auth::id();

            $mycourses = DB::table('courses')
                ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
                ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.view", '=',  '1')
            ->get();

            return view('library', compact('courses', 'mycourses', 'datacourses', 'trails'));

        }
        
        return view('library', compact('courses', 'datacourses', 'trails'));

    }    

}
