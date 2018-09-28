<?php

namespace App\Http\Controllers\Admin;

use App\Datacourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatacoursesRequest;
use App\Http\Requests\Admin\UpdateDatacoursesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatacoursesController extends Controller
{
    /**
     * Display a listing of Datacourse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('datacourse_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Datacourse::query();
            $query->with("user");
            $query->with("course");
            $query->with("certificate");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('datacourse_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'datacourses.id',
                'datacourses.view',
                'datacourses.progress',
                'datacourses.rating',
                'datacourses.testimonal',
                'datacourses.user_id',
                'datacourses.course_id',
                'datacourses.certificate_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'datacourse_';
                $routeKey = 'admin.datacourses';

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

        $generals = \App\General::get();

        return view('admin.datacourses.index', compact('generals'));
    }

    /**
     * Show the form for creating new Datacourse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('datacourse_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Coursescertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $generals = \App\General::get();

        return view('admin.datacourses.create', compact('users', 'courses', 'certificates', 'generals'));
    }

    /**
     * Store a newly created Datacourse in storage.
     *
     * @param  \App\Http\Requests\StoreDatacoursesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatacoursesRequest $request)
    {
        if (! Gate::allows('datacourse_create')) {
            return abort(401);
        }
        $datacourse = Datacourse::create($request->all());



        return redirect()->route('admin.datacourses.index');
    }


    /**
     * Show the form for editing Datacourse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('datacourse_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Coursescertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $datacourse = Datacourse::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.datacourses.edit', compact('datacourse', 'users', 'courses', 'certificates', 'generals'));
    }

    /**
     * Update Datacourse in storage.
     *
     * @param  \App\Http\Requests\UpdateDatacoursesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatacoursesRequest $request, $id)
    {
        if (! Gate::allows('datacourse_edit')) {
            return abort(401);
        }
        $datacourse = Datacourse::findOrFail($id);
        $datacourse->update($request->all());



        return redirect()->route('admin.datacourses.index');
    }


    /**
     * Display Datacourse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('datacourse_view')) {
            return abort(401);
        }
        $datacourse = Datacourse::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.datacourses.show', compact('datacourse', 'generals'));
    }


    /**
     * Remove Datacourse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('datacourse_delete')) {
            return abort(401);
        }
        $datacourse = Datacourse::findOrFail($id);
        $datacourse->delete();

        return redirect()->route('admin.datacourses.index');
    }

    /**
     * Delete all selected Datacourse at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('datacourse_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Datacourse::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Datacourse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('datacourse_delete')) {
            return abort(401);
        }
        $datacourse = Datacourse::onlyTrashed()->findOrFail($id);
        $datacourse->restore();

        return redirect()->route('admin.datacourses.index');
    }

    /**
     * Permanently delete Datacourse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('datacourse_delete')) {
            return abort(401);
        }
        $datacourse = Datacourse::onlyTrashed()->findOrFail($id);
        $datacourse->forceDelete();

        return redirect()->route('admin.datacourses.index');
    }
}
