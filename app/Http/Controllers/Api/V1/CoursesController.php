<?php

namespace App\Http\Controllers\Api\V1;

use App\Course;
use Illuminate\Http\Request;
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

    public function index()
    {
        return Course::all();
    }

    public function show($id)
    {
        return Course::findOrFail($id);
    }

    public function update(UpdateCoursesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $course = Course::findOrFail($id);
        $course->update($request->all());
        

        return $course;
    }

    public function store(StoreCoursesRequest $request)
    {
        $request = $this->saveFiles($request);
        $course = Course::create($request->all());
        

        return $course;
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return '';
    }
}
