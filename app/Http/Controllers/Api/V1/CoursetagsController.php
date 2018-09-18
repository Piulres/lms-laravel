<?php

namespace App\Http\Controllers\Api\V1;

use App\Coursetag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursetagsRequest;
use App\Http\Requests\Admin\UpdateCoursetagsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursetagsController extends Controller
{
    public function index()
    {
        return Coursetag::all();
    }

    public function show($id)
    {
        return Coursetag::findOrFail($id);
    }

    public function update(UpdateCoursetagsRequest $request, $id)
    {
        $coursetag = Coursetag::findOrFail($id);
        $coursetag->update($request->all());
        

        return $coursetag;
    }

    public function store(StoreCoursetagsRequest $request)
    {
        $coursetag = Coursetag::create($request->all());
        

        return $coursetag;
    }

    public function destroy($id)
    {
        $coursetag = Coursetag::findOrFail($id);
        $coursetag->delete();
        return '';
    }
}
