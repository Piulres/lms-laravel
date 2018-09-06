<?php

namespace App\Http\Controllers\Api\V1;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLessonsRequest;
use App\Http\Requests\Admin\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LessonsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Lesson::all();
    }

    public function show($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update(UpdateLessonsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        

        return $lesson;
    }

    public function store(StoreLessonsRequest $request)
    {
        $request = $this->saveFiles($request);
        $lesson = Lesson::create($request->all());
        

        return $lesson;
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return '';
    }
}
