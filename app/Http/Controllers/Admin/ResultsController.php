<?php

namespace App\Http\Controllers\Admin;

use App\Test;
use App\TestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
   
    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Test::all()->load('user');

        $results = $results->where('user_id', '=', Auth::id());
        
         $generals = \App\General::get();

        return view('admin.results.index', compact('results','generals'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id)->load('user');

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
        }

        return view('admin.results.show', compact('test', 'results'));
    }
}
