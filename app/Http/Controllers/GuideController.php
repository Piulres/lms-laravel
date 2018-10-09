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

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Faker\Test\Provider\Collection;

class GuideController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = \App\Course::latest()->get();
        $trails = DB::table('trails')->get();

        if (Auth::check()) {
        
            if 
                (! Gate::allows('trail_access')) {
                return redirect('login');
            }

            $user = Auth::id();

            // dd($mytrails);
            $mytrails = DB::table('trails')
                ->leftJoin('datatrails', 'trails.id', '=', 'datatrails.trail_id')
                ->leftJoin('users', 'datatrails.user_id', '=', 'users.id')
             ->where("datatrails.user_id", '=',  $user)
             ->where("datatrails.view", '=',  '1')
            ->get();            

            $trail_list = array();
            $mytrail_list = array();
            
            foreach($trails as $trail){
                array_push($trail_list,$trail->id);
            }

            foreach($mytrails as $mytrail){
                array_push($mytrail_list,$mytrail->trail_id);
            }

            $diff_list = array_diff($trail_list,$mytrail_list);

            $diff = collect();

            foreach($diff_list as $item){
                $a = DB::table('trails')
                    ->where('id','=',$item)
                    ->first();
                $diff->push($a);
            }

            //dd($mytrails);

            return view('guide', compact('trails', 'mytrails', 'datatrails', 'trails','diff'));

        }

        $mytrails = collect();

        return view('guide', compact('trails', 'datatrails', 'trails', 'mytrails'));

    }    

}
