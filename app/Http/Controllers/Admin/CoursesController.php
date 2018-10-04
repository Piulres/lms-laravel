<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursesRequest;
use App\Http\Requests\Admin\UpdateCoursesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('course_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Course::query();
            $query->with("instructor");
            $query->with("lessons");
            $query->with("categories");
            $query->with("tags");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('course_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'courses.id',
                'courses.order',
                'courses.title',
                'courses.slug',
                'courses.description',
                'courses.introduction',
                'courses.featured_image',
                'courses.duration',
                'courses.start_date',
                'courses.end_date',
                'courses.approved',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'course_';
                $routeKey = 'admin.courses';

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
                if($row->featured_image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->featured_image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->featured_image) .'"/>'; };
            });
            $table->editColumn('instructor.name', function ($row) {
                if(count($row->instructor) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->instructor->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('lessons.title', function ($row) {
                if(count($row->lessons) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->lessons->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('duration', function ($row) {
                return $row->duration ? $row->duration : '';
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

            $table->rawColumns(['actions','massDelete','featured_image','instructor.name','lessons.title','categories.title','tags.title','approved']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.courses.index', compact('generals'));
    }

    /**
     * Show the form for creating new Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('course_create')) {
            return abort(401);
        }
        
        $instructors = \App\User::get()->pluck('name', 'id');

        $lessons = \App\Lesson::get()->pluck('title', 'id');

        $categories = \App\Coursecategory::get()->pluck('title', 'id');

        $tags = \App\Coursetag::get()->pluck('title', 'id');

        $generals = \App\General::get();

        return view('admin.courses.create', compact('instructors', 'lessons', 'categories', 'tags', 'generals'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param  \App\Http\Requests\StoreCoursesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesRequest $request)
    {
        if (! Gate::allows('course_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $course = Course::create($request->all());
        $course->instructor()->sync(array_filter((array)$request->input('instructor')));
        $course->lessons()->sync(array_filter((array)$request->input('lessons')));
        $course->categories()->sync(array_filter((array)$request->input('categories')));
        $course->tags()->sync(array_filter((array)$request->input('tags')));

        DB::table('coursescertificates')
        ->insert([
            'id'=> $course->id,
            'order'=> $course->id,
            'title'=> $course->title,
            'slug'=> $course->title,
            'updated_at' => $course->updated_at,
            'created_at' => $course->created_at,
        ]);

        return redirect()->route('admin.courses.index');
    }


    /**
     * Show the form for editing Course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('course_edit')) {
            return abort(401);
        }
        
        $instructors = \App\User::get()->pluck('name', 'id');

        $lessons = \App\Lesson::get()->pluck('title', 'id');

        $categories = \App\Coursecategory::get()->pluck('title', 'id');

        $tags = \App\Coursetag::get()->pluck('title', 'id');

        $generals = \App\General::get();

        $course = Course::findOrFail($id);

        return view('admin.courses.edit', compact('course', 'instructors', 'lessons', 'categories', 'tags', 'generals'));
    }

    /**
     * Update Course in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursesRequest $request, $id)
    {
        if (! Gate::allows('course_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $course = Course::findOrFail($id);
        $course->update($request->all());
        $course->instructor()->sync(array_filter((array)$request->input('instructor')));
        $course->lessons()->sync(array_filter((array)$request->input('lessons')));
        $course->categories()->sync(array_filter((array)$request->input('categories')));
        $course->tags()->sync(array_filter((array)$request->input('tags')));



        return redirect()->route('admin.courses.index');
    }


    /**
     * Display Course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('course_view')) {
            return abort(401);
        }
        
        $instructors = \App\User::get()->pluck('name', 'id');

        $lessons = \App\Lesson::get()->pluck('title', 'id');

        $categories = \App\Coursecategory::get()->pluck('title', 'id');

        $tags = \App\Coursetag::get()->pluck('title', 'id');
$datacourses = \App\Datacourse::where('course_id', $id)->get();$trails = \App\Trail::whereHas('courses',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $course = Course::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.courses.show', compact('course', 'datacourses', 'trails', 'generals'));
    }


    /**
     * Remove Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::findOrFail($id);
        $course->delete();

        return back();
    }

    /**
     * Delete all selected Course at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('course_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Course::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('admin.courses.index');
    }

    /**
     * Permanently delete Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('course_delete')) {
            return abort(401);
        }
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();

        return redirect()->route('admin.courses.index');
    }
}
