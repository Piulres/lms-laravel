<?php

namespace App\Http\Controllers\Admin;

use App\Trailtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailtagsRequest;
use App\Http\Requests\Admin\UpdateTrailtagsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailtagsController extends Controller
{
    /**
     * Display a listing of Trailtag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trailtag_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Trailtag.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Trailtag.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('trailtag_delete')) {
                return abort(401);
            }
            $trailtags = Trailtag::onlyTrashed()->get();
        } else {
            $trailtags = Trailtag::all();
        }

        $generals = \App\General::get();

        return view('admin.trailtags.index', compact('trailtags', 'generals'));
    }

    /**
     * Show the form for creating new Trailtag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trailtag_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.trailtags.create', compact('generals'));
    }

    /**
     * Store a newly created Trailtag in storage.
     *
     * @param  \App\Http\Requests\StoreTrailtagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailtagsRequest $request)
    {
        if (! Gate::allows('trailtag_create')) {
            return abort(401);
        }
        $trailtag = Trailtag::create($request->all());



        return redirect()->route('admin.trailtags.index');
    }


    /**
     * Show the form for editing Trailtag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trailtag_edit')) {
            return abort(401);
        }
        $trailtag = Trailtag::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailtags.edit', compact('trailtag', 'generals'));
    }

    /**
     * Update Trailtag in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailtagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailtagsRequest $request, $id)
    {
        if (! Gate::allows('trailtag_edit')) {
            return abort(401);
        }
        $trailtag = Trailtag::findOrFail($id);
        $trailtag->update($request->all());



        return redirect()->route('admin.trailtags.index');
    }


    /**
     * Display Trailtag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trailtag_view')) {
            return abort(401);
        }
        $trails = \App\Trail::whereHas('tags',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $trailtag = Trailtag::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailtags.show', compact('trailtag', 'trails', 'generals'));
    }


    /**
     * Remove Trailtag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trailtag_delete')) {
            return abort(401);
        }
        $trailtag = Trailtag::findOrFail($id);
        $trailtag->delete();

        return redirect()->route('admin.trailtags.index');
    }

    /**
     * Delete all selected Trailtag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trailtag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trailtag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trailtag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trailtag_delete')) {
            return abort(401);
        }
        $trailtag = Trailtag::onlyTrashed()->findOrFail($id);
        $trailtag->restore();

        return redirect()->route('admin.trailtags.index');
    }

    /**
     * Permanently delete Trailtag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trailtag_delete')) {
            return abort(401);
        }
        $trailtag = Trailtag::onlyTrashed()->findOrFail($id);
        $trailtag->forceDelete();

        return redirect()->route('admin.trailtags.index');
    }
}
