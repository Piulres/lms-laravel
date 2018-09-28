<?php

namespace App\Http\Controllers\Admin;

use App\Trailscertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailscertificatesRequest;
use App\Http\Requests\Admin\UpdateTrailscertificatesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailscertificatesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Trailscertificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trailscertificate_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Trailscertificate::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('trailscertificate_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'trailscertificates.id',
                'trailscertificates.order',
                'trailscertificates.title',
                'trailscertificates.slug',
                'trailscertificates.image',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trailscertificate_';
                $routeKey = 'admin.trailscertificates';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('image', function ($row) {
                if($row->image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->image) .'"/>'; };
            });

            $table->rawColumns(['actions','massDelete','image']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.trailscertificates.index', compact('generals'));
    }

    /**
     * Show the form for creating new Trailscertificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trailscertificate_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.trailscertificates.create', compact('generals'));
    }

    /**
     * Store a newly created Trailscertificate in storage.
     *
     * @param  \App\Http\Requests\StoreTrailscertificatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailscertificatesRequest $request)
    {
        if (! Gate::allows('trailscertificate_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $trailscertificate = Trailscertificate::create($request->all());



        return redirect()->route('admin.trailscertificates.index');
    }


    /**
     * Show the form for editing Trailscertificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trailscertificate_edit')) {
            return abort(401);
        }
        $trailscertificate = Trailscertificate::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailscertificates.edit', compact('trailscertificate', 'generals'));
    }

    /**
     * Update Trailscertificate in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailscertificatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailscertificatesRequest $request, $id)
    {
        if (! Gate::allows('trailscertificate_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $trailscertificate = Trailscertificate::findOrFail($id);
        $trailscertificate->update($request->all());



        return redirect()->route('admin.trailscertificates.index');
    }


    /**
     * Display Trailscertificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trailscertificate_view')) {
            return abort(401);
        }
        $datatrails = \App\Datatrail::where('certificate_id', $id)->get();

        $trailscertificate = Trailscertificate::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trailscertificates.show', compact('trailscertificate', 'datatrails', 'generals'));
    }


    /**
     * Remove Trailscertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trailscertificate_delete')) {
            return abort(401);
        }
        $trailscertificate = Trailscertificate::findOrFail($id);
        $trailscertificate->delete();

        return redirect()->route('admin.trailscertificates.index');
    }

    /**
     * Delete all selected Trailscertificate at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trailscertificate_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trailscertificate::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trailscertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trailscertificate_delete')) {
            return abort(401);
        }
        $trailscertificate = Trailscertificate::onlyTrashed()->findOrFail($id);
        $trailscertificate->restore();

        return redirect()->route('admin.trailscertificates.index');
    }

    /**
     * Permanently delete Trailscertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trailscertificate_delete')) {
            return abort(401);
        }
        $trailscertificate = Trailscertificate::onlyTrashed()->findOrFail($id);
        $trailscertificate->forceDelete();

        return redirect()->route('admin.trailscertificates.index');
    }
}
