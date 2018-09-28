<?php

namespace App\Http\Controllers\Admin;

use App\Coursecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursecategoriesRequest;
use App\Http\Requests\Admin\UpdateCoursecategoriesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursecategoriesController extends Controller
{
    /**
     * Display a listing of Coursecategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('coursecategory_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('coursecategory_delete')) {
                return abort(401);
            }
            $coursecategories = Coursecategory::onlyTrashed()->get();
        } else {
            $coursecategories = Coursecategory::all();
        }

        $generals = \App\General::get();

        return view('admin.coursecategories.index', compact('coursecategories', 'generals'));
    }

    /**
     * Show the form for creating new Coursecategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('coursecategory_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.coursecategories.create', compact('generals'));
    }

    /**
     * Store a newly created Coursecategory in storage.
     *
     * @param  \App\Http\Requests\StoreCoursecategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursecategoriesRequest $request)
    {
        if (! Gate::allows('coursecategory_create')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::create($request->all());



        return redirect()->route('admin.coursecategories.index');
    }


    /**
     * Show the form for editing Coursecategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('coursecategory_edit')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursecategories.edit', compact('coursecategory', 'generals'));
    }

    /**
     * Update Coursecategory in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursecategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursecategoriesRequest $request, $id)
    {
        if (! Gate::allows('coursecategory_edit')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::findOrFail($id);
        $coursecategory->update($request->all());



        return redirect()->route('admin.coursecategories.index');
    }


    /**
     * Display Coursecategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('coursecategory_view')) {
            return abort(401);
        }
        $courses = \App\Course::whereHas('categories',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $coursecategory = Coursecategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursecategories.show', compact('coursecategory', 'courses', 'generals'));
    }


    /**
     * Remove Coursecategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('coursecategory_delete')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::findOrFail($id);
        $coursecategory->delete();

        return redirect()->route('admin.coursecategories.index');
    }

    /**
     * Delete all selected Coursecategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('coursecategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Coursecategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Coursecategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('coursecategory_delete')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::onlyTrashed()->findOrFail($id);
        $coursecategory->restore();

        return redirect()->route('admin.coursecategories.index');
    }

    /**
     * Permanently delete Coursecategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('coursecategory_delete')) {
            return abort(401);
        }
        $coursecategory = Coursecategory::onlyTrashed()->findOrFail($id);
        $coursecategory->forceDelete();

        return redirect()->route('admin.coursecategories.index');
    }
}
