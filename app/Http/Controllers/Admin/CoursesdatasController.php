<?php

namespace App\Http\Controllers\Admin;

use App\Coursesdatum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursesdatasRequest;
use App\Http\Requests\Admin\UpdateCoursesdatasRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursesdatasController extends Controller
{
    /**
     * Display a listing of Coursesdatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('coursesdatum_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Coursesdatum::query();
            $query->with("user");
            $query->with("course");
            $query->with("certificate");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('coursesdatum_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'coursesdatas.id',
                'coursesdatas.view',
                'coursesdatas.progress',
                'coursesdatas.rating',
                'coursesdatas.testimonal',
                'coursesdatas.user_id',
                'coursesdatas.course_id',
                'coursesdatas.certificate_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'coursesdatum_';
                $routeKey = 'admin.coursesdatas';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('view', function ($row) {
                return $row->view ? $row->view : '';
            });
            $table->editColumn('progress', function ($row) {
                return $row->progress ? $row->progress : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });
            $table->editColumn('testimonal', function ($row) {
                return $row->testimonal ? $row->testimonal : '';
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('course.title', function ($row) {
                return $row->course ? $row->course->title : '';
            });
            $table->editColumn('certificate.title', function ($row) {
                return $row->certificate ? $row->certificate->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.coursesdatas.index');
    }

    /**
     * Show the form for creating new Coursesdatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('coursesdatum_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Coursescertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.coursesdatas.create', compact('users', 'courses', 'certificates'));
    }

    /**
     * Store a newly created Coursesdatum in storage.
     *
     * @param  \App\Http\Requests\StoreCoursesdatasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesdatasRequest $request)
    {
        if (! Gate::allows('coursesdatum_create')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::create($request->all());



        return redirect()->route('admin.coursesdatas.index');
    }


    /**
     * Show the form for editing Coursesdatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('coursesdatum_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Coursescertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $coursesdatum = Coursesdatum::findOrFail($id);

        return view('admin.coursesdatas.edit', compact('coursesdatum', 'users', 'courses', 'certificates'));
    }

    /**
     * Update Coursesdatum in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursesdatasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursesdatasRequest $request, $id)
    {
        if (! Gate::allows('coursesdatum_edit')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::findOrFail($id);
        $coursesdatum->update($request->all());



        return redirect()->route('admin.coursesdatas.index');
    }


    /**
     * Display Coursesdatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('coursesdatum_view')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::findOrFail($id);

        return view('admin.coursesdatas.show', compact('coursesdatum'));
    }


    /**
     * Remove Coursesdatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('coursesdatum_delete')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::findOrFail($id);
        $coursesdatum->delete();

        return redirect()->route('admin.coursesdatas.index');
    }

    /**
     * Delete all selected Coursesdatum at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('coursesdatum_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Coursesdatum::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Coursesdatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('coursesdatum_delete')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::onlyTrashed()->findOrFail($id);
        $coursesdatum->restore();

        return redirect()->route('admin.coursesdatas.index');
    }

    /**
     * Permanently delete Coursesdatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('coursesdatum_delete')) {
            return abort(401);
        }
        $coursesdatum = Coursesdatum::onlyTrashed()->findOrFail($id);
        $coursesdatum->forceDelete();

        return redirect()->route('admin.coursesdatas.index');
    }
}
