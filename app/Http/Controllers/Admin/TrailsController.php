<?php

namespace App\Http\Controllers\Admin;

use App\Trail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailsRequest;
use App\Http\Requests\Admin\UpdateTrailsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailsController extends Controller
{
    /**
     * Display a listing of Trail.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trail_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Trail::query();
            $query->with("courses");
            $query->with("categories");
            $query->with("tags");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('trail_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'trails.id',
                'trails.order',
                'trails.title',
                'trails.slug',
                'trails.description',
                'trails.introduction',
                'trails.featured_image',
                'trails.start_date',
                'trails.end_date',
                'trails.approved',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trail_';
                $routeKey = 'admin.trails';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('introduction', function ($row) {
                return $row->introduction ? $row->introduction : '';
            });
            $table->editColumn('featured_image', function ($row) {
                return $row->featured_image ? $row->featured_image : '';
            });
            $table->editColumn('courses.title', function ($row) {
                if(count($row->courses) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->courses->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('start_date', function ($row) {
                return $row->start_date ? $row->start_date : '';
            });
            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : '';
            });
            $table->editColumn('categories.title', function ($row) {
                if(count($row->categories) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->categories->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('tags.title', function ($row) {
                if(count($row->tags) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->tags->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('approved', function ($row) {
                return \Form::checkbox("approved", 1, $row->approved == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','courses.title','categories.title','tags.title','approved']);

            return $table->make(true);
        }

        $generals = \App\General::get();
        return view('admin.trails.index', compact('generals'));
    }

    /**
     * Show the form for creating new Trail.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trail_create')) {
            return abort(401);
        }
        
        $courses = \App\Course::get()->pluck('title', 'id');

        $categories = \App\Trailcategory::get()->pluck('title', 'id');

        $tags = \App\Trailtag::get()->pluck('title', 'id');

        $generals = \App\General::get();

        return view('admin.trails.create', compact('courses', 'categories', 'tags', 'generals'));
    }

    /**
     * Store a newly created Trail in storage.
     *
     * @param  \App\Http\Requests\StoreTrailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailsRequest $request)
    {
        if (! Gate::allows('trail_create')) {
            return abort(401);
        }
        $trail = Trail::create($request->all());
        $trail->courses()->sync(array_filter((array)$request->input('courses')));
        $trail->categories()->sync(array_filter((array)$request->input('categories')));
        $trail->tags()->sync(array_filter((array)$request->input('tags')));



        return redirect()->route('admin.trails.index');
    }


    /**
     * Show the form for editing Trail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trail_edit')) {
            return abort(401);
        }
        
        $courses = \App\Course::get()->pluck('title', 'id');

        $categories = \App\Trailcategory::get()->pluck('title', 'id');

        $tags = \App\Trailtag::get()->pluck('title', 'id');


        $trail = Trail::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trails.edit', compact('trail', 'courses', 'categories', 'tags', 'generals'));
    }

    /**
     * Update Trail in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailsRequest $request, $id)
    {
        if (! Gate::allows('trail_edit')) {
            return abort(401);
        }
        $trail = Trail::findOrFail($id);
        $trail->update($request->all());
        $trail->courses()->sync(array_filter((array)$request->input('courses')));
        $trail->categories()->sync(array_filter((array)$request->input('categories')));
        $trail->tags()->sync(array_filter((array)$request->input('tags')));



        return redirect()->route('admin.trails.index');
    }


    /**
     * Display Trail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trail_view')) {
            return abort(401);
        }
        
        $courses = \App\Course::get()->pluck('title', 'id');

        $categories = \App\Trailcategory::get()->pluck('title', 'id');

        $tags = \App\Trailtag::get()->pluck('title', 'id');
$datatrails = \App\Datatrail::where('trail_id', $id)->get();

        $trail = Trail::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.trails.show', compact('trail', 'datatrails', 'generals'));
    }


    /**
     * Remove Trail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trail_delete')) {
            return abort(401);
        }
        $trail = Trail::findOrFail($id);
        $trail->delete();

        return redirect()->route('admin.trails.index');
    }

    /**
     * Delete all selected Trail at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trail_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trail::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trail_delete')) {
            return abort(401);
        }
        $trail = Trail::onlyTrashed()->findOrFail($id);
        $trail->restore();

        return redirect()->route('admin.trails.index');
    }

    /**
     * Permanently delete Trail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trail_delete')) {
            return abort(401);
        }
        $trail = Trail::onlyTrashed()->findOrFail($id);
        $trail->forceDelete();

        return redirect()->route('admin.trails.index');
    }
}
