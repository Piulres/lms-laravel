<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreDatacoursesRequest;
use App\Http\Requests\Admin\StoreDatatrailsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Datacourse;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = \App\User::latest()->get(); 
        $courses = \App\Course::latest()->get(); 
        $trails = \App\Trail::latest()->get(); 
        $faqquestions = \App\FaqQuestion::latest()->get();

        $generals = \App\General::get();

        return view('index', compact( 'users', 'courses', 'trails', 'faqquestions', 'generals' ));
    }

    public function speech()
    {

        return view('speech');
    }

    public function home()
    {
        
        $user = Auth::id();
        $users = \App\User::latest()->get(); 
        $courses = \App\Course::latest()->get(); 
        $trails = \App\Trail::latest()->get();

        $faqquestions = \App\FaqQuestion::latest()->get(); 
        $certificates = \App\Coursescertificate::latest()->get();
        $datacourses = \App\Datacourse::latest()->get();

        $check_role = DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
         ->where('users.id', '=',  $user)
        ->limit(1)
        ->pluck('role_id');

        $mycourses = DB::table('courses')
                ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
                ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
             ->where("datacourses.user_id", '=',  $user)
             ->where("datacourses.view", '=',  '1')
            ->get();   

        $mymessages = DB::table('messenger_topics')
            ->leftJoin('users', 'messenger_topics.sender_id', '=', 'users.id')
         ->where('messenger_topics.receiver_id', '=',  $user)
        ->get();

        $mycertificates = DB::table('coursescertificates')
            ->leftJoin('datacourses', 'coursescertificates.id', '=', 'datacourses.certificate_id')
            ->whereNotNull('datacourses.certificate_id')
        ->get();

        // Testimonal

        $mycoursetestimonals = DB::table('datacourses')
            ->leftJoin('courses', 'datacourses.course_id', '=', 'courses.id')
        ->where('datacourses.user_id', '=', $user)
        ->where('datacourses.progress', '=', 100)
        ->where('datacourses.testimonal', '=', NULL)
        // ->whereNotNull('datacourses.certificate_id')
       ->get();

       $mytrailtestimonals = DB::table('datatrails')
            ->leftJoin('trails', 'datatrails.trail_id', '=', 'trails.id')
        ->where('datatrails.user_id', '=', $user)
        ->where('datatrails.progress', '=', 100)
        ->where('datatrails.testimonal', '=', NULL)
        // ->whereNotNull('datacourses.certificate_id')
       ->get();
      

        $generals = \App\General::get();

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

        // dd($mycourses);
        // dd($check_role[0]);

        return view('home', compact( 'users', 'mymessages', 'check_role', 'courses', 'diff', 'mycourses', 'trails', 'faqquestions', 'certificates', 'mycertificates', 'mycoursetestimonals','mytrailtestimonals', 'generals' ));
    }

    public function testimonal()
    {
        return redirect('admin/home');
    }

    public function savecoursefeedback(StoreDatacoursesRequest $request)
    {         
        DB::table('datacourses')
        ->where('datacourses.user_id','=', $request->user_id)
        ->where('datacourses.course_id','=', $request->course_id)
        ->update([
            'rating' => $request->rating,
            'testimonal' => $request->testimonal,
        ]);        
        
        return redirect('admin/home');
    }

    public function savetrailfeedback(StoreDatatrailsRequest $request)
    {         
        DB::table('datatrails')
        ->where('datatrails.user_id','=', $request->user_id)
        ->where('datatrails.trail_id','=', $request->trail_id)
        ->update([
            'rating' => $request->rating,
            'testimonal' => $request->testimonal,
        ]);        
        
        return redirect('admin/home');
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Admin')
            {
                return true;
            }
        }
    }

}