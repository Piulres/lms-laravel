<?php

namespace App\Http\Controllers\Admin;

use App\Datatrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatatrailsRequest;
use App\Http\Requests\Admin\UpdateDatatrailsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatatrailsController extends Controller
{
    /**
     * Display a listing of Datatrail.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('datatrail_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Datatrail::query();
            $query->with("trail");
            $query->with("user");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('datatrail_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'datatrails.id',
                'datatrails.trail_id',
                'datatrails.user_id',
                'datatrails.view',
                'datatrails.progress',
                'datatrails.rating',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'datatrail_';
                $routeKey = 'admin.datatrails';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('trail.title', function ($row) {
                return $row->trail ? $row->trail->title : '';
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('view', function ($row) {
                return \Form::checkbox("view", 1, $row->view == 1, ["disabled"]);
            });
            $table->editColumn('progress', function ($row) {
                return $row->progress ? $row->progress : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });

            $table->rawColumns(['actions','massDelete','view']);

            return $table->make(true);
        }

        return view('admin.datatrails.index');
    }

    /**
     * Show the form for creating new Datatrail.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('datatrail_create')) {
            return abort(401);
        }
        
        $trails = \App\Trail::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.datatrails.create', compact('trails', 'users'));
    }

    /**
     * Store a newly created Datatrail in storage.
     *
     * @param  \App\Http\Requests\StoreDatatrailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatatrailsRequest $request)
    {
        if (! Gate::allows('datatrail_create')) {
            return abort(401);
        }
        $datatrail = Datatrail::create($request->all());



        return redirect()->route('admin.datatrails.index');
    }


    /**
     * Show the form for editing Datatrail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('datatrail_edit')) {
            return abort(401);
        }
        
        $trails = \App\Trail::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $datatrail = Datatrail::findOrFail($id);

        return view('admin.datatrails.edit', compact('datatrail', 'trails', 'users'));
    }

    /**
     * Update Datatrail in storage.
     *
     * @param  \App\Http\Requests\UpdateDatatrailsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatatrailsRequest $request, $id)
    {
        if (! Gate::allows('datatrail_edit')) {
            return abort(401);
        }
        $datatrail = Datatrail::findOrFail($id);
        $datatrail->update($request->all());



        return redirect()->route('admin.datatrails.index');
    }


    /**
     * Display Datatrail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('datatrail_view')) {
            return abort(401);
        }
        $datatrail = Datatrail::findOrFail($id);

        return view('admin.datatrails.show', compact('datatrail'));
    }


    /**
     * Remove Datatrail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('datatrail_delete')) {
            return abort(401);
        }
        $datatrail = Datatrail::findOrFail($id);
        $datatrail->delete();

        return redirect()->route('admin.datatrails.index');
    }

    /**
     * Delete all selected Datatrail at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('datatrail_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Datatrail::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Datatrail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('datatrail_delete')) {
            return abort(401);
        }
        $datatrail = Datatrail::onlyTrashed()->findOrFail($id);
        $datatrail->restore();

        return redirect()->route('admin.datatrails.index');
    }

    /**
     * Permanently delete Datatrail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('datatrail_delete')) {
            return abort(401);
        }
        $datatrail = Datatrail::onlyTrashed()->findOrFail($id);
        $datatrail->forceDelete();

        return redirect()->route('admin.datatrails.index');
    }
}
