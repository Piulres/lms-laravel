<?php

namespace App\Http\Controllers\Admin;

use App\Coursescategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursescategoriesRequest;
use App\Http\Requests\Admin\UpdateCoursescategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursescategoriesController extends Controller
{
    /**
     * Display a listing of Coursescategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('coursescategory_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Coursescategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('coursescategory_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'coursescategories.id',
                'coursescategories.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'coursescategory_';
                $routeKey = 'admin.coursescategories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.coursescategories.index');
    }

    /**
     * Show the form for creating new Coursescategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('coursescategory_create')) {
            return abort(401);
        }
        return view('admin.coursescategories.create');
    }

    /**
     * Store a newly created Coursescategory in storage.
     *
     * @param  \App\Http\Requests\StoreCoursescategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursescategoriesRequest $request)
    {
        if (! Gate::allows('coursescategory_create')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::create($request->all());



        return redirect()->route('admin.coursescategories.index');
    }


    /**
     * Show the form for editing Coursescategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('coursescategory_edit')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::findOrFail($id);

        return view('admin.coursescategories.edit', compact('coursescategory'));
    }

    /**
     * Update Coursescategory in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursescategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursescategoriesRequest $request, $id)
    {
        if (! Gate::allows('coursescategory_edit')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::findOrFail($id);
        $coursescategory->update($request->all());



        return redirect()->route('admin.coursescategories.index');
    }


    /**
     * Display Coursescategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('coursescategory_view')) {
            return abort(401);
        }
        $courses = \App\Course::whereHas('categories',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $coursescategory = Coursescategory::findOrFail($id);

        return view('admin.coursescategories.show', compact('coursescategory', 'courses'));
    }


    /**
     * Remove Coursescategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('coursescategory_delete')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::findOrFail($id);
        $coursescategory->delete();

        return redirect()->route('admin.coursescategories.index');
    }

    /**
     * Delete all selected Coursescategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('coursescategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Coursescategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Coursescategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('coursescategory_delete')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::onlyTrashed()->findOrFail($id);
        $coursescategory->restore();

        return redirect()->route('admin.coursescategories.index');
    }

    /**
     * Permanently delete Coursescategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('coursescategory_delete')) {
            return abort(401);
        }
        $coursescategory = Coursescategory::onlyTrashed()->findOrFail($id);
        $coursescategory->forceDelete();

        return redirect()->route('admin.coursescategories.index');
    }
}
