<?php

namespace App\Http\Controllers\Admin;

use App\Coursetag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursetagsRequest;
use App\Http\Requests\Admin\UpdateCoursetagsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursetagsController extends Controller
{
    /**
     * Display a listing of Coursetag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('coursetag_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Coursetag.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Coursetag.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('coursetag_delete')) {
                return abort(401);
            }
            $coursetags = Coursetag::onlyTrashed()->get();
        } else {
            $coursetags = Coursetag::all();
        }

        $generals = \App\General::get();

        return view('admin.coursetags.index', compact('coursetags', 'generals'));
    }

    /**
     * Show the form for creating new Coursetag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('coursetag_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.coursetags.create', compact('generals'));
    }

    /**
     * Store a newly created Coursetag in storage.
     *
     * @param  \App\Http\Requests\StoreCoursetagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursetagsRequest $request)
    {
        if (! Gate::allows('coursetag_create')) {
            return abort(401);
        }
        $coursetag = Coursetag::create($request->all());



        return redirect()->route('admin.coursetags.index');
    }


    /**
     * Show the form for editing Coursetag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('coursetag_edit')) {
            return abort(401);
        }
        $coursetag = Coursetag::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursetags.edit', compact('coursetag', 'generals'));
    }

    /**
     * Update Coursetag in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursetagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursetagsRequest $request, $id)
    {
        if (! Gate::allows('coursetag_edit')) {
            return abort(401);
        }
        $coursetag = Coursetag::findOrFail($id);
        $coursetag->update($request->all());



        return redirect()->route('admin.coursetags.index');
    }


    /**
     * Display Coursetag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('coursetag_view')) {
            return abort(401);
        }
        $courses = \App\Course::whereHas('tags',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $coursetag = Coursetag::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursetags.show', compact('coursetag', 'courses', 'generals'));
    }


    /**
     * Remove Coursetag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('coursetag_delete')) {
            return abort(401);
        }
        $coursetag = Coursetag::findOrFail($id);
        $coursetag->delete();

        return redirect()->route('admin.coursetags.index');
    }

    /**
     * Delete all selected Coursetag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('coursetag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Coursetag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Coursetag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('coursetag_delete')) {
            return abort(401);
        }
        $coursetag = Coursetag::onlyTrashed()->findOrFail($id);
        $coursetag->restore();

        return redirect()->route('admin.coursetags.index');
    }

    /**
     * Permanently delete Coursetag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('coursetag_delete')) {
            return abort(401);
        }
        $coursetag = Coursetag::onlyTrashed()->findOrFail($id);
        $coursetag->forceDelete();

        return redirect()->route('admin.coursetags.index');
    }
}
