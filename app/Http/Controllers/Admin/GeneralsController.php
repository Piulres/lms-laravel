<?php

namespace App\Http\Controllers\Admin;

use App\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGeneralsRequest;
use App\Http\Requests\Admin\UpdateGeneralsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class GeneralsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of General.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('general_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = General::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('general_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'generals.id',
                'generals.site_name',
                'generals.site_logo',
                'generals.theme_color',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'general_';
                $routeKey = 'admin.generals';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('site_name', function ($row) {
                return $row->site_name ? $row->site_name : '';
            });
            $table->editColumn('site_logo', function ($row) {
                if($row->site_logo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->site_logo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->site_logo) .'"/>'; };
            });
            $table->editColumn('theme_color', function ($row) {
                return $row->theme_color ? $row->theme_color : '';
            });

            $table->rawColumns(['actions','massDelete','site_logo']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.generals.index', compact('generals'));
    }

    /**
     * Show the form for creating new General.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('general_create')) {
            return abort(401);
        }

        $generals = \App\General::get();
        return view('admin.generals.create', compact('generals'));
    }

    /**
     * Store a newly created General in storage.
     *
     * @param  \App\Http\Requests\StoreGeneralsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGeneralsRequest $request)
    {
        if (! Gate::allows('general_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $general = General::create($request->all());



        return redirect()->route('admin.generals.index');
    }


    /**
     * Show the form for editing General.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('general_edit')) {
            return abort(401);
        }
        $general = General::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.generals.edit', compact('general', 'generals'));
    }

    /**
     * Update General in storage.
     *
     * @param  \App\Http\Requests\UpdateGeneralsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGeneralsRequest $request, $id)
    {
        if (! Gate::allows('general_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $general = General::findOrFail($id);
        $general->update($request->all());



        return redirect()->route('admin.generals.index');
    }


    /**
     * Display General.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('general_view')) {
            return abort(401);
        }
        $general = General::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.generals.show', compact('general', 'generals'));
    }


    /**
     * Remove General from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('general_delete')) {
            return abort(401);
        }
        $general = General::findOrFail($id);
        $general->delete();

        return redirect()->route('admin.generals.index');
    }

    /**
     * Delete all selected General at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('general_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = General::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore General from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('general_delete')) {
            return abort(401);
        }
        $general = General::onlyTrashed()->findOrFail($id);
        $general->restore();

        return redirect()->route('admin.generals.index');
    }

    /**
     * Permanently delete General from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('general_delete')) {
            return abort(401);
        }
        $general = General::onlyTrashed()->findOrFail($id);
        $general->forceDelete();

        return redirect()->route('admin.generals.index');
    }
}
