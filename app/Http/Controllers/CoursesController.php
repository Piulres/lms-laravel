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

        return view('courses', compact('course', 'datacourses', 'trails'));

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

        $datacourses = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->limit(1)
        ->get();

         
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

            return view('certificate', compact('course'));

        }else{

        return redirect('library');

        }
    }

    public function done($id)
    {
        
        // check access
        if (! Gate::allows('course_access')) {
            return redirect('login');
        }

        // call vars
        $course = Course::findOrFail($id);
        $user = Auth::id();
        $lessons = DB::table('lessons')
            ->leftJoin('course_lesson', 'lessons.id', '=', 'course_lesson.lesson_id')
            ->where("course_lesson.course_id", '=',  $id)
        ->get();
        $coursescertificates = DB::table('coursescertificates')
         ->get();

        
        // certificate
        $check_certificate = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->limit(1)
        ->get();


        if ($check_certificate[0]->progress == '100') {

            // dd($course->id);
            DB::table('datacourses')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.course_id", '=',  $id)
             // ->limit(1)
            ->update(['datacourses.certificate_id' => $id]);

        }

        // DB::table('lessons')         
        //     ->where("lessons.id", '=',  $id)
        //     ->limit(1)
        // ->update(['lessons.status'=> '2']);
        
        // DB::table('datacourses')
        //  ->where("datacourses.user_id", '=',  $user)
        //  ->where("datacourses.course_id", '=',  $course->id)
        //  ->limit(1)
        // ->update(['datacourses.progress'=> '0']);

        DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->where('view', '=', NULL)
        ->delete();

        $datacourses = DB::table('datacourses')
         ->where("datacourses.user_id", '=',  $user)
         ->where("datacourses.course_id", '=',  $course->id)
         ->limit(1)
        ->get();

        return back();        
    }
}
