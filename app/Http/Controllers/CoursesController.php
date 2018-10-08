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
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
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

        // $data = \App\Datacourse::get();

        $datas = DB::table('datacourses')
                ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
             ->where("datacourses.view", '=',  '1')
             ->where("datacourses.course_id", '=',  $id)
             ->limit(3)
            ->get();        

        $trails = \App\Trail::whereHas('courses',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $course = Course::findOrFail($id);

        $lists = DB::table('courses')
         ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
         ->where("courses.id", '=',  $id)
        ->get();

        $generals = \App\General::get();


        return view('courses', compact('course','datas', 'star', 'lists', 'datacourses', 'trails', 'generals'));
    }
 
    public function start($id)
    {
        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $lists = DB::table('courses')
         ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
         ->where("courses.id", '=',  $id)
        ->get();

        $course = Course::findOrFail($id);

        $user = Auth::id();

        $lessonsfull = DB::table('lessons')
         ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
         ->where("course_lesson.course_id", '=',  $id)
        ->get();

        $lessons = DB::table('lessons')
         ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
         ->where("course_lesson.course_id", '=',  $id)
        ->paginate(1);

        // $lessons = DB::table('lessons')
        //  ->leftJoin('datalessons', 'lessons.id', '=', 'datalessons.lesson_id')
        //  ->where("datalessons.course_id", '=',  $id)
        //  ->where("datalessons.user_id", '=',  $user)
        // ->paginate(1);

        $total_lessons = DB::table('lessons')
          ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
          ->where("course_lesson.course_id", '=',  $id)
        ->count();

        $datacourses = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $id)
         ->limit(1)
        ->get();

        $check_done_course = DB::table('datalessons')
         ->where("datalessons.user_id", '=',  $user)
         ->where("datalessons.course_id", '=',  $id)
         ->where("datalessons.view", '=',  1)
        ->count();

        // ////////////////////////////////////////////

        // check lesson number
        if ($total_lessons == 0) {            
            $percentage = 100;            
        } else {
            $percentage = 100 / $total_lessons;        
        }

        // create
        \App\Datacourse::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'course_id' => $id
        ],
        ['view' => '0']);

        // add data to lessons
        for($count = 0; $count < $total_lessons; $count++)
        {
            
            $jaja = \App\Datalesson::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'course_id' => $id,
                    'lesson_id' => $lessonsfull[$count]->id
                ],
                ['progress' => $percentage]
            );

        }        

        // add course to mycourses
        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $id)
         ->limit(1)
        ->update(['datacourses.view'=> '1']);

        // delete duplicate course
        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $id)
         ->where('view', '=', NULL)
        ->delete();       


        // add progress
        if ($check_done_course == $total_lessons) {

            DB::table('datacourses')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.course_id", '=',  $id)
             ->limit(1)
            ->update(['datacourses.progress'=> '100']);

        } else {

            $actual_progress = DB::table('datalessons')
             ->where("datalessons.user_id", '=',  $user)
             ->where("datalessons.course_id", '=',  $id)
             ->where("datalessons.view", '=',  1)
            ->sum('progress');

            DB::table('datacourses')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.course_id", '=',  $id)
            ->update(['datacourses.progress' => $actual_progress]);
        }     
        

        // add certificate
        $check_certificate = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $id)
         // ->limit(1)
        ->get();

        if ($check_certificate[0]->progress == 100) {

            // dd($course->id);
            DB::table('datacourses')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.course_id", '=',  $id)
            ->update(['datacourses.certificate_id' => $id]);

        }

        // session variables
        Session::put('course', $datacourses[0]->course_id);
        Session::put('percentage', $percentage);
       
        return view('oncourse', compact('course', 'lists', 'datacourses', 'lessons', 'total_lessons'));
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

        return back();
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

        return back();
    }  

    public function certificate($id)
    {
        if 
            (! Gate::allows('course_access')) {
            return redirect('login');
        }
        
        $user = Auth::id();

        /*        DB::table('datacourses')->insert([
                    'view'=>'1',
                    'progress'=>'100',
                    'rating'=>'5',
                    'user_id'=>$user,
                    'course_id'=>$id,
                ]);
        */

        $course = DB::table('courses')
            ->leftJoin('datacourses', 'course_id', '=', 'courses.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->where("datacourses.course_id", '=',  $id)
            ->where("datacourses.user_id", '=',  $user)
            ->limit(1)
            ->get();
        
        if($course[0]->progress == 100){

            $count = DB::table('coursescertificates')->count();

            DB::table('coursescertificates')->insert([
                'order'=>$count++,
                'title'=>$course[0]->title,
                'slug'=>$course[0]->name,
            ]);

            return view('courses/certificate', compact('course'));

        }else{

        return redirect('library');

        }
    }

    public function done($id)
    {
        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        $user = Auth::id();

        $course = Session::get('course');
        $percentage = Session::get('percentage');
        
        \App\Datalesson::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $course,
                'lesson_id' => $id
            ],
            ['view' => 1]
        );

        return back();
    }
}
