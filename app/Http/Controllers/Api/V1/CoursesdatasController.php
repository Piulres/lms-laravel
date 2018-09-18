<?php

namespace App\Http\Controllers\Api\V1;

use App\Coursesdatum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursesdatasRequest;
use App\Http\Requests\Admin\UpdateCoursesdatasRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursesdatasController extends Controller
{
    public function index()
    {
        return Coursesdatum::all();
    }

    public function show($id)
    {
        return Coursesdatum::findOrFail($id);
    }

    public function update(UpdateCoursesdatasRequest $request, $id)
    {
        $coursesdatum = Coursesdatum::findOrFail($id);
        $coursesdatum->update($request->all());
        

        return $coursesdatum;
    }

    public function store(StoreCoursesdatasRequest $request)
    {
        $coursesdatum = Coursesdatum::create($request->all());
        

        return $coursesdatum;
    }

    public function destroy($id)
    {
        $coursesdatum = Coursesdatum::findOrFail($id);
        $coursesdatum->delete();
        return '';
    }
}
