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
use Faker\Test\Provider\Collection;

class LibraryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = \App\Course::latest()->get();
        $courses = DB::table('courses')->get();

        if (Auth::check()) {
        
            if 
                (! Gate::allows('course_access')) {
                return redirect('login');
            }

            $user = Auth::id();

            // dd($mycourses);
            $mycourses = DB::table('courses')
                ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
                ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.view", '=',  '1')
            ->get();            

            $course_list = array();
            $mycourse_list = array();
            
            foreach($courses as $course){
                array_push($course_list,$course->id);
            }

            foreach($mycourses as $mycourse){
                array_push($mycourse_list,$mycourse->course_id);
            }

            $diff_list = array_diff($course_list,$mycourse_list);

            $diff = collect();

            foreach($diff_list as $item){
                $a = DB::table('courses')
                    ->where('id','=',$item)
                    ->first();
                $diff->push($a);
            }

            return view('library', compact('courses', 'mycourses', 'datacourses', 'trails','diff'));

        }

        $mycourses = collect();

        return view('library', compact('courses', 'datacourses', 'trails', 'mycourses'));

    }    

}
