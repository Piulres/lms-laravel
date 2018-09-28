<?php

namespace App\Http\Controllers\Admin;

use App\Trailcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailcategoriesRequest;
use App\Http\Requests\Admin\UpdateTrailcategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailcategoriesController extends Controller
{
    /**
     * Display a listing of Trailcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trailcategory_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Trailcategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('trailcategory_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'trailcategories.id',
                'trailcategories.title',
                'trailcategories.slug',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trailcategory_';
                $routeKey = 'admin.trailcategories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        $generals = \App\General::get();
        return view('admin.trailcategories.index', compact('generals'));
    }

    /**
     * Show the form for creating new Trailcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trailcategory_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.trailcategories.create', compact('generals'));
    }

    /**
     * Store a newly created Trailcategory in storage.
     *
     * @param  \App\Http\Requests\StoreTrailcategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailcategoriesRequest $request)
    {
        if (! Gate::allows('trailcategory_create')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::create($request->all());



        return redirect()->route('admin.trailcategories.index');
    }


    /**
     * Show the form for editing Trailcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trailcategory_edit')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailcategories.edit', compact('trailcategory', 'generals'));
    }

    /**
     * Update Trailcategory in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailcategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailcategoriesRequest $request, $id)
    {
        if (! Gate::allows('trailcategory_edit')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::findOrFail($id);
        $trailcategory->update($request->all());



        return redirect()->route('admin.trailcategories.index');
    }


    /**
     * Display Trailcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trailcategory_view')) {
            return abort(401);
        }
        $trails = \App\Trail::whereHas('categories',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $trailcategory = Trailcategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailcategories.show', compact('trailcategory', 'trails', 'generals'));
    }


    /**
     * Remove Trailcategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trailcategory_delete')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::findOrFail($id);
        $trailcategory->delete();

        return redirect()->route('admin.trailcategories.index');
    }

    /**
     * Delete all selected Trailcategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trailcategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trailcategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trailcategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trailcategory_delete')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::onlyTrashed()->findOrFail($id);
        $trailcategory->restore();

        return redirect()->route('admin.trailcategories.index');
    }

    /**
     * Permanently delete Trailcategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trailcategory_delete')) {
            return abort(401);
        }
        $trailcategory = Trailcategory::onlyTrashed()->findOrFail($id);
        $trailcategory->forceDelete();

        return redirect()->route('admin.trailcategories.index');
    }
}
