<?php

namespace App\Http\Controllers\Admin;

use App\Trailscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailscategoriesRequest;
use App\Http\Requests\Admin\UpdateTrailscategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailscategoriesController extends Controller
{
    /**
     * Display a listing of Trailscategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trailscategory_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Trailscategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('trailscategory_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'trailscategories.id',
                'trailscategories.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trailscategory_';
                $routeKey = 'admin.trailscategories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.trailscategories.index');
    }

    /**
     * Show the form for creating new Trailscategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trailscategory_create')) {
            return abort(401);
        }
        return view('admin.trailscategories.create');
    }

    /**
     * Store a newly created Trailscategory in storage.
     *
     * @param  \App\Http\Requests\StoreTrailscategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailscategoriesRequest $request)
    {
        if (! Gate::allows('trailscategory_create')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::create($request->all());



        return redirect()->route('admin.trailscategories.index');
    }


    /**
     * Show the form for editing Trailscategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trailscategory_edit')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::findOrFail($id);

        return view('admin.trailscategories.edit', compact('trailscategory'));
    }

    /**
     * Update Trailscategory in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailscategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailscategoriesRequest $request, $id)
    {
        if (! Gate::allows('trailscategory_edit')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::findOrFail($id);
        $trailscategory->update($request->all());



        return redirect()->route('admin.trailscategories.index');
    }


    /**
     * Display Trailscategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trailscategory_view')) {
            return abort(401);
        }
        $trails = \App\Trail::whereHas('categories',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $trailscategory = Trailscategory::findOrFail($id);

        return view('admin.trailscategories.show', compact('trailscategory', 'trails'));
    }


    /**
     * Remove Trailscategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trailscategory_delete')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::findOrFail($id);
        $trailscategory->delete();

        return redirect()->route('admin.trailscategories.index');
    }

    /**
     * Delete all selected Trailscategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trailscategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trailscategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trailscategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trailscategory_delete')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::onlyTrashed()->findOrFail($id);
        $trailscategory->restore();

        return redirect()->route('admin.trailscategories.index');
    }

    /**
     * Permanently delete Trailscategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trailscategory_delete')) {
            return abort(401);
        }
        $trailscategory = Trailscategory::onlyTrashed()->findOrFail($id);
        $trailscategory->forceDelete();

        return redirect()->route('admin.trailscategories.index');
    }
}
