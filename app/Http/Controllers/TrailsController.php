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
        ->count();
        
        $datatrails = DB::table('datatrails')
        ->where("datatrails.user_id", '=',  $user)
        ->where("datatrails.trail_id", '=',  $id)
        ->limit(1)
        ->get();
        
        $check_done_trail = DB::table('course_trail')
        ->leftJoin('datatrails','course_trail.trail_id','=','datatrails.trail_id')
        ->where("datatrails.user_id", '=',  $user)
        ->where("datatrails.trail_id", '=',  $id)
        ->where("datatrails.view", '=',  1)
        ->count();
        
        // ////////////////////////////////////////////

        // create
        \App\Datatrail::updateOrCreate(
        [
            'user_id' => $user,
            'trail_id' => $id,
        ],
        ['view' => '0']);

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

        

        // add progress
        if ($check_done_trail == $total_courses) {

            DB::table('datatrails')
             ->where("datatrails.user_id", '=',  $user)
             ->where("datatrails.trail_id", '=',  $id)
             ->limit(1)
            ->update(['datatrails.progress'=> '100']);

        } else {

            $courses_done = DB::table('course_trail')
            ->leftJoin('datatrails','course_trail.trail_id','=','datatrails.trail_id')
            ->where("datatrails.user_id", '=',  $user)
            ->where("datatrails.trail_id", '=',  $id)
            ->where("datatrails.view", '=',  1)
            ->where("datatrails.progress", '=',  100)
            ->get();

            $actual_progress = $courses_done * $percent;

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
