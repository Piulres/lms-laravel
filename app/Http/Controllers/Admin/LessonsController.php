<?php

namespace App\Http\Controllers\Admin;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLessonsRequest;
use App\Http\Requests\Admin\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LessonsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('lesson_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('lesson_delete')) {
                return abort(401);
            }
            $lessons = Lesson::onlyTrashed()->get();
        } else {
            $lessons = Lesson::all();
        }

        $generals = \App\General::get();

        $courses = \App\Course::get();

        return view('admin.lessons.index', compact('lessons', 'generals', 'courses'));
    }

    /**
     * Show the form for creating new Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.lessons.create', compact('generals'));
    }

    /**
     * Store a newly created Lesson in storage.
     *
     * @param  \App\Http\Requests\StoreLessonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonsRequest $request)
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::create($request->all());



        return redirect()->route('admin.lessons.index');
    }


    /**
     * Show the form for editing Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.lessons.edit', compact('lesson', 'generals'));
    }





    /**
     * Duplicate the form for the Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function duplicate($id)
    {
        if (! Gate::allows('lesson_access')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);
        $new_lesson = $lesson->replicate();
        $new_lesson->save();
        $new_lesson->slug = $new_lesson->slug . '' . $new_lesson->id;
        $new_lesson->save();

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Update Lesson in storage.
     *
     * @param  \App\Http\Requests\UpdateLessonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonsRequest $request, $id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());



        return redirect()->route('admin.lessons.index');
    }


    /**
     * Display Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('lesson_view')) {
            return abort(401);
        }
        $courses = \App\Course::whereHas('lessons',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $lesson = Lesson::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.lessons.show', compact('lesson', 'courses', 'generals'));
    }


    /**
     * Remove Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Delete all selected Lesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->restore();

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Permanently delete Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->forceDelete();

        return redirect()->route('admin.lessons.index');
    }


}
