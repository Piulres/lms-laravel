<?php

namespace App\Http\Controllers\Admin;

use App\Traildatum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTraildatasRequest;
use App\Http\Requests\Admin\UpdateTraildatasRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TraildatasController extends Controller
{
    /**
     * Display a listing of Traildatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('traildatum_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Traildatum::query();
            $query->with("user");
            $query->with("trail");
            $query->with("certificate");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('traildatum_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'traildatas.id',
                'traildatas.view',
                'traildatas.progress',
                'traildatas.rating',
                'traildatas.testimonal',
                'traildatas.user_id',
                'traildatas.trail_id',
                'traildatas.certificate_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'traildatum_';
                $routeKey = 'admin.traildatas';

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
            $table->editColumn('trail.title', function ($row) {
                return $row->trail ? $row->trail->title : '';
            });
            $table->editColumn('certificate.title', function ($row) {
                return $row->certificate ? $row->certificate->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.traildatas.index');
    }

    /**
     * Show the form for creating new Traildatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('traildatum_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $trails = \App\Trail::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Trailscertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.traildatas.create', compact('users', 'trails', 'certificates'));
    }

    /**
     * Store a newly created Traildatum in storage.
     *
     * @param  \App\Http\Requests\StoreTraildatasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraildatasRequest $request)
    {
        if (! Gate::allows('traildatum_create')) {
            return abort(401);
        }
        $traildatum = Traildatum::create($request->all());



        return redirect()->route('admin.traildatas.index');
    }


    /**
     * Show the form for editing Traildatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('traildatum_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $trails = \App\Trail::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $certificates = \App\Trailscertificate::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $traildatum = Traildatum::findOrFail($id);

        return view('admin.traildatas.edit', compact('traildatum', 'users', 'trails', 'certificates'));
    }

    /**
     * Update Traildatum in storage.
     *
     * @param  \App\Http\Requests\UpdateTraildatasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTraildatasRequest $request, $id)
    {
        if (! Gate::allows('traildatum_edit')) {
            return abort(401);
        }
        $traildatum = Traildatum::findOrFail($id);
        $traildatum->update($request->all());



        return redirect()->route('admin.traildatas.index');
    }


    /**
     * Display Traildatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('traildatum_view')) {
            return abort(401);
        }
        $traildatum = Traildatum::findOrFail($id);

        return view('admin.traildatas.show', compact('traildatum'));
    }


    /**
     * Remove Traildatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('traildatum_delete')) {
            return abort(401);
        }
        $traildatum = Traildatum::findOrFail($id);
        $traildatum->delete();

        return redirect()->route('admin.traildatas.index');
    }

    /**
     * Delete all selected Traildatum at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('traildatum_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Traildatum::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Traildatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('traildatum_delete')) {
            return abort(401);
        }
        $traildatum = Traildatum::onlyTrashed()->findOrFail($id);
        $traildatum->restore();

        return redirect()->route('admin.traildatas.index');
    }

    /**
     * Permanently delete Traildatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('traildatum_delete')) {
            return abort(401);
        }
        $traildatum = Traildatum::onlyTrashed()->findOrFail($id);
        $traildatum->forceDelete();

        return redirect()->route('admin.traildatas.index');
    }
}
