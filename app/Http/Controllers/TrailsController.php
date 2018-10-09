<?php

namespace App\Http\Controllers;

use App\Trail;
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
use App\Course;

class TrailsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $courses = Trail::latest()->get();
        return view('trails', compact('trail', 'datatrails'));
    }

    public function show($id)
    {

        $instructors = \App\User::get()->pluck('name', 'id');       

        $courses = \App\Course::get()->pluck('title', 'id');

        $categories = \App\Trailcategory::get()->pluck('title', 'id');

        $datatrails = \App\Datatrail::where('trail_id', $id)->get();

        // $data = \App\Datacourse::get();

        $datas = DB::table('datatrails')
                ->leftJoin('users', 'datatrails.user_id', '=', 'users.id')
             ->where("datatrails.view", '=',  '1')
             ->where("datatrails.trail_id", '=',  $id)
             ->limit(3)
            ->get();

        $trail = Trail::findOrFail($id);

        $lists = DB::table('trails')
         ->leftJoin('datatrails', 'trails.id', '=', 'datatrails.trail_id')
         ->where("trails.id", '=',  $id)
        ->get();

        $generals = \App\General::get();


        return view('trails', compact('trail','datas', 'star', 'lists', 'datatrails', 'generals'));
    }

    public function start($id)
    {
        if (! Gate::allows('trail_access')) {
            return redirect('login');
        }

        $lists = DB::table('trails')
         ->leftJoin('datatrails', 'trails.id', '=', 'datatrails.trail_id')
         ->where("trails.id", '=',  $id)
        ->get();

        $trail = Trail::findOrFail($id);

        $user = Auth::id();

        $coursesfull = DB::table('courses')
         ->leftJoin('course_trail', 'courses.id', '=', 'course_trail.course_id')
         ->where("course_trail.trail_id", '=',  $id)
        ->get();

        $courses = DB::table('courses')
        ->leftJoin('course_trail', 'courses.id', '=', 'course_trail.course_id')
        ->where("course_trail.trail_id", '=',  $id)
        ->paginate(1);

         $total_courses = DB::table('course_trail')
        ->leftJoin('courses', 'course_trail.course_id', '=', 'courses.id')
        ->where("course_trail.trail_id", '=',  $id)
        ->get();
        
        $datatrails = DB::table('datatrails')
        ->where("datatrails.user_id", '=',  $user)
        ->where("datatrails.trail_id", '=',  $id)
        ->limit(1)
        ->get();
        
        $user_course_list = DB::table('datacourses')
        ->leftJoin('course_trail', 'course_trail.course_id', '=', 'datacourses.course_id')
        ->leftJoin('courses', 'course_trail.course_id', '=', 'courses.id')
        ->where('datacourses.user_id','=',$user)
        ->where('datacourses.progress','=',100)
        ->where('course_trail.trail_id','=',$id)
        ->get();

        // ////////////////////////////////////////////

        // create
        \App\Datatrail::updateOrCreate(
        [
            'user_id' => $user,
            'trail_id' => $id,
        ],
        ['view' => '0']);

        // start trail courses
        //dd($total_courses);
        foreach($total_courses as $c){
            $cc = DB::table('datacourses')
            ->where('datacourses.user_id','=',$user)
            ->where('datacourses.course_id','=',$c->course_id)
            ->first();
            if($cc===null){
                app('App\Http\Controllers\CoursesController')->add($c->course_id);
            }
        }

        // add trail to mytrails
        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $id)
         ->limit(1)
        ->update(['datatrails.view'=> '1']);

        // delete duplicate trail
        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $id)
         ->where('view', '=', NULL)
        ->delete();

        
        // check completes courses
        $check_done_trail = collect();
        foreach($user_course_list as $item){
            $a = DB::table('courses')
            ->where('courses.id','=',$item->course_id)
            ->first();
            $check_done_trail->push($a);
        }

        // add progress
        if ($check_done_trail->count() == $total_courses->count()) {

            DB::table('datatrails')
             ->where("datatrails.user_id", '=',  $user)
             ->where("datatrails.trail_id", '=',  $id)
             ->limit(1)
            ->update(['datatrails.progress'=> '100']);

        } else {
            
            if ($total_courses->count() == 0) {            
                $percent = 100;            
            } else {
                $percent = 100 / $total_courses->count();        
            }

            $actual_progress = $user_course_list->count() * $percent;

            DB::table('datatrails')
             ->where("datatrails.user_id", '=',  $user)
             ->where("datatrails.trail_id", '=',  $id)
            ->update(['datatrails.progress' => $actual_progress]);
        }     
        

        // add certificate
        $check_certificate = DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $id)
         // ->limit(1)
        ->get();

        if ($check_certificate[0]->progress == 100) {

            // dd($course->id);
            DB::table('datatrails')
             ->where("datatrails.user_id", '=',  $user)
             ->where("datatrails.trail_id", '=',  $id)
            ->update(['datatrails.certificate_id' => $id]);

        }

        // session variables
        Session::put('trail', $datatrails[0]->trail_id);
       
        return view('ontrail', compact('trail', 'lists', 'datatrails', 'courses', 'total_courses'));
    }

    public function add($id)
    {
        if (! Gate::allows('trail_access')) {
            return redirect('login');
        }

        $trail = Trail::findOrFail($id);
        $user = Auth::id();

        \App\Datatrail::updateOrCreate([
            'user_id' => Auth::id(),
            'trail_id' => $trail->id,
            'view' => '0',
            'progress' => '0',
        ]);

        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $trail->id)
         ->limit(1)
        ->update(['datatrails.view'=> '1']);

        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $trail->id)
         ->where('view', '=', NULL)
        ->delete();      

        return back();
    }

    public function remove($id)
    {
        if 
            (! Gate::allows('trail_access')) {
            return redirect('login');
        }

        $trail = Trail::findOrFail($id);
        $user = Auth::id();

        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $trail->id)
         ->where("datatrails.view", '=',  '1')
         ->limit(1)
        ->update(['datatrails.view'=> '0']);

        DB::table('datatrails')
         ->where("datatrails.user_id", '=',  $user)
         ->where("datatrails.trail_id", '=',  $trail->id)
         ->where('view', '=', NULL)
        ->delete();

        return back();
    }

    public function certificate($id)
    {
        if 
            (! Gate::allows('trail_access')) {
            return redirect('login');
        }
        
        $user = Auth::id();

        $trail = DB::table('trails')
            ->leftJoin('datatrails', 'trail_id', '=', 'trails.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->where("datatrails.trail_id", '=',  $id)
            ->where("datatrails.user_id", '=',  $user)
            ->limit(1)
            ->get();
        
        if($trail[0]->progress == 100){

            $count = DB::table('trailscertificates')->count();

            DB::table('trailscertificates')->insert([
                'order'=>$count++,
                'title'=>$trail[0]->title,
                'slug'=>$trail[0]->name,
            ]);

            return view('trails/certificate', compact('trail'));

        }else{

        return redirect('library');

        }
    }

    public function done($id)
    {
        if (! Gate::allows('trail_access')) {
            return redirect('login');
        }

        $user = Auth::id();

        $trail = Session::get('trail');
        $percentage = Session::get('percentage');
        
        \App\Datacourse::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'trail_id' => $trail,
                'course_id' => $id
            ],
            ['view' => 1]
        );

        return back();
    }
}
