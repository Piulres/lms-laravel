<?php

namespace App\Http\Controllers\Admin;

use App\Coursescertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursescertificatesRequest;
use App\Http\Requests\Admin\UpdateCoursescertificatesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursescertificatesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Coursescertificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('coursescertificate_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Coursescertificate::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('coursescertificate_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'coursescertificates.id',
                'coursescertificates.order',
                'coursescertificates.title',
                'coursescertificates.slug',
                'coursescertificates.image',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'coursescertificate_';
                $routeKey = 'admin.coursescertificates';

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

        return view('admin.coursescertificates.index', compact('generals'));
    }

    /**
     * Show the form for creating new Coursescertificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('coursescertificate_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.coursescertificates.create', compact('generals'));
    }

    /**
     * Store a newly created Coursescertificate in storage.
     *
     * @param  \App\Http\Requests\StoreCoursescertificatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursescertificatesRequest $request)
    {
        if (! Gate::allows('coursescertificate_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $coursescertificate = Coursescertificate::create($request->all());



        return redirect()->route('admin.coursescertificates.index');
    }


    /**
     * Show the form for editing Coursescertificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('coursescertificate_edit')) {
            return abort(401);
        }
        $coursescertificate = Coursescertificate::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursescertificates.edit', compact('coursescertificate', 'generals'));
    }

    /**
     * Update Coursescertificate in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursescertificatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursescertificatesRequest $request, $id)
    {
        if (! Gate::allows('coursescertificate_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $coursescertificate = Coursescertificate::findOrFail($id);
        $coursescertificate->update($request->all());



        return redirect()->route('admin.coursescertificates.index');
    }


    /**
     * Display Coursescertificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('coursescertificate_view')) {
            return abort(401);
        }
        $datacourses = \App\Datacourse::where('certificate_id', $id)->get();

        $coursescertificate = Coursescertificate::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.coursescertificates.show', compact('coursescertificate', 'datacourses', 'generals'));
    }


    /**
     * Remove Coursescertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('coursescertificate_delete')) {
            return abort(401);
        }
        $coursescertificate = Coursescertificate::findOrFail($id);
        $coursescertificate->delete();

        return redirect()->route('admin.coursescertificates.index');
    }

    /**
     * Delete all selected Coursescertificate at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('coursescertificate_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Coursescertificate::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Coursescertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('coursescertificate_delete')) {
            return abort(401);
        }
        $coursescertificate = Coursescertificate::onlyTrashed()->findOrFail($id);
        $coursescertificate->restore();

        return redirect()->route('admin.coursescertificates.index');
    }

    /**
     * Permanently delete Coursescertificate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('coursescertificate_delete')) {
            return abort(401);
        }
        $coursescertificate = Coursescertificate::onlyTrashed()->findOrFail($id);
        $coursescertificate->forceDelete();

        return redirect()->route('admin.coursescertificates.index');
    }
}
