<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreDatacoursesRequest;

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
        
        $users = \App\User::latest()->limit(5)->get(); 
        $courses = \App\Course::latest()->limit(5)->get(); 
        $trails = \App\Trail::latest()->limit(5)->get(); 
        $faqquestions = \App\FaqQuestion::latest()->limit(5)->get(); 

        return view('index', compact( 'users', 'courses', 'trails', 'faqquestions' ));
    }

    public function home()
    {
        
        $user = Auth::id();
        $users = \App\User::latest()->limit(5)->get(); 
        $courses = \App\Course::latest()->limit(5)->get(); 
        $trails = \App\Trail::latest()->limit(5)->get(); 
        $faqquestions = \App\FaqQuestion::latest()->limit(5)->get(); 
        $certificates = \App\Coursescertificate::latest()->get();
        $datacourses = \App\Datacourse::latest()->get(); 

        $mycourses = DB::table('courses')
            ->leftJoin('datacourses', 'courses.id', '=', 'datacourses.course_id')
            ->leftJoin('users', 'datacourses.user_id', '=', 'users.id')
         ->where('datacourses.user_id', '=',  $user)
         ->where('datacourses.view', '=',  '1')
        ->get();

        $mycertificates = DB::table('coursescertificates')
            ->leftJoin('datacourses', 'coursescertificates.id', '=', 'datacourses.certificate_id')
            // ->where('datacourses.user_id', '=',  $user)
         // ->where('datacourses.certificate_id', '=',  NOTNULL)
            ->whereNotNull('datacourses.certificate_id')
        ->get();

        // $mycertificates = DB::table('coursescertificates')
        //  ->where("coursescertificates.id", '=', '1')
        // ->get();

        // dd($mycertificates);

        $mytestimonals = DB::table('datacourses')
            ->leftJoin('courses', 'datacourses.course_id', '=', 'courses.id')
        ->where('datacourses.user_id', '=', $user)
        ->where('datacourses.progress', '=', 100)
        ->where('datacourses.testimonal', '=', '')
        ->whereNotNull('datacourses.certificate_id')
       ->get();

       //dd($mytestimonals);

        return view('home', compact( 'users', 'courses', 'mycourses', 'trails', 'faqquestions', 'certificates', 'mycertificates', 'mytestimonals' ));
    }

    public function testimonal()
    {
        return redirect('admin/home');
    }

    public function savefeedback(StoreDatacoursesRequest $request)
    {
        //dd($request);        
        DB::table('datacourses')
        ->where('datacourses.user_id','=', $request->user_id)
        ->where('datacourses.course_id','=', $request->course_id)
        ->update([
            'rating' => $request->rating,
            'testimonal' => $request->testimonal,
        ]);        
        
        return redirect('admin/home');
    }
}
