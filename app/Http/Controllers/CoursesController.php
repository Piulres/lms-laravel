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
class CoursesController extends Controller
{
    use FileUploadTrait;    


    public function index()
    {

        $courses = Course::latest()->get();
        return view('courses', compact('course', 'datacourses', 'trails'));

    }

    public function show($id)
    {

        $instructors = \App\User::get()->pluck('name', 'id');       

        $lessons = \App\Lesson::get()->pluck('title', 'id');

        $categories = \App\Coursecategory::get()->pluck('title', 'id');

        $datacourses = \App\Datacourse::where('course_id', $id)->get();

        $trails = \App\Trail::whereHas('courses',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $course = Course::findOrFail($id);

        $generals = \App\General::get();

        return view('courses', compact('course', 'datacourses', 'trails', 'generals'));
    }
 
    public function start($id)
    {

        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $course = Course::findOrFail($id);

        $user = Auth::id();

        $lessons = DB::table('lessons')
            ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
            ->where("course_lesson.course_id", '=',  $id)
        ->get();        

        $datacourses = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->limit(1)
        ->get();

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->where('view', '=', NULL)
        ->delete();

        \App\Datacourse::updateOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'view' => '0',
            'progress' => '0',
        ]);
         
        return view('oncourse', compact('course', 'datacourses', 'lessons'));

    }

    public function add($id)
    {

        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $course = Course::findOrFail($id);
        $user = Auth::id();

        \App\Datacourse::updateOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'view' => '0',
            'progress' => '0',
        ]);

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->limit(1)
        ->update(['datacourses.view'=> '1']);

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->where('view', '=', NULL)
        ->delete();      

        return redirect('library');

    }

    public function remove($id)
    {

        if 
            (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $course = Course::findOrFail($id);
        $user = Auth::id();

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->where("datacourses.view", '=',  '1')
         ->limit(1)
        ->update(['datacourses.view'=> '0']);

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->where('view', '=', NULL)
        ->delete(); 

            // DB::table('jaja')
            // ->where('name', '=', 'John')
            // ->where(function ($query) {
            //     $query->where('votes', '>', 100)
            //           ->orWhere('title', '=', 'Admin');
            // })
            // ->get();

        return redirect('library');

    }

    public function done($id)
    {
        
        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $course = Course::findOrFail($id);

        $user = Auth::id();

        $lessons = DB::table('lessons')
            ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
            ->where("course_lesson.course_id", '=',  $id)
        ->get();        

        $datacourses = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->limit(1)
        ->get();

        DB::table('lessons')         
            ->where("lessons.id", '=',  $id)
            ->limit(1)
        ->update(['lessons.status'=> '2']);

        return back();
        
    }

}
