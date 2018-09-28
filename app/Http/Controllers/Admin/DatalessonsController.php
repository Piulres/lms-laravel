<?php

namespace App\Http\Controllers\Admin;

use App\Datalesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatalessonsRequest;
use App\Http\Requests\Admin\UpdateDatalessonsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatalessonsController extends Controller
{
    /**
     * Display a listing of Datalesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('datalesson_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Datalesson::query();
            $query->with("user");
            $query->with("course");
            $query->with("lesson");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('datalesson_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'datalessons.id',
                'datalessons.view',
                'datalessons.progress',
                'datalessons.user_id',
                'datalessons.course_id',
                'datalessons.lesson_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'datalesson_';
                $routeKey = 'admin.datalessons';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('view', function ($row) {
                return $row->view ? $row->view : '';
            });
            $table->editColumn('progress', function ($row) {
                return $row->progress ? $row->progress : '';
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('course.title', function ($row) {
                return $row->course ? $row->course->title : '';
            });
            $table->editColumn('lesson.title', function ($row) {
                return $row->lesson ? $row->lesson->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.datalessons.index', compact('generals'));
    }

    /**
     * Show the form for creating new Datalesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('datalesson_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $lessons = \App\lesson::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $generals = \App\General::get();

        return view('admin.datalessons.create', compact('users', 'courses', 'lessons', 'generals'));
    }

    /**
     * Store a newly created Datalesson in storage.
     *
     * @param  \App\Http\Requests\StoreDatalessonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatalessonsRequest $request)
    {
        if (! Gate::allows('datalesson_create')) {
            return abort(401);
        }
        $datalesson = Datalesson::create($request->all());



        return redirect()->route('admin.datalessons.index');
    }


    /**
     * Show the form for editing Datalesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('datalesson_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $lessons = \App\Lesson::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        
        $datalesson = Datalesson::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.datalessons.edit', compact('datalesson', 'users', 'courses', 'lessons', 'generals'));
    }

    /**
     * Update Datalesson in storage.
     *
     * @param  \App\Http\Requests\UpdateDatalessonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatalessonsRequest $request, $id)
    {
        if (! Gate::allows('datalesson_edit')) {
            return abort(401);
        }
        $datalesson = Datalesson::findOrFail($id);
        $datalesson->update($request->all());



        return redirect()->route('admin.datalessons.index');
    }


    /**
     * Display Datalesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('datalesson_view')) {
            return abort(401);
        }
        $datalesson = Datalesson::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.datalessons.show', compact('datalesson', 'generals'));
    }


    /**
     * Remove Datalesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('datalesson_delete')) {
            return abort(401);
        }
        $datalesson = Datalesson::findOrFail($id);
        $datalesson->delete();

        return redirect()->route('admin.datalessons.index');
    }

    /**
     * Delete all selected Datalesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('datalesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Datalesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Datalesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('datalesson_delete')) {
            return abort(401);
        }
        $datalesson = Datalesson::onlyTrashed()->findOrFail($id);
        $datalesson->restore();

        return redirect()->route('admin.datalessons.index');
    }

    /**
     * Permanently delete Datalesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('datalesson_delete')) {
            return abort(401);
        }
        $datalesson = Datalesson::onlyTrashed()->findOrFail($id);
        $datalesson->forceDelete();

        return redirect()->route('admin.datalessons.index');
    }
}
