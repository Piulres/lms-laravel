<?php

namespace App\Http\Controllers\Api\V1;

use App\Coursecategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursecategoriesRequest;
use App\Http\Requests\Admin\UpdateCoursecategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursecategoriesController extends Controller
{
    public function index()
    {
        return Coursecategory::all();
    }

    public function show($id)
    {
        return Coursecategory::findOrFail($id);
    }

    public function update(UpdateCoursecategoriesRequest $request, $id)
    {
        $coursecategory = Coursecategory::findOrFail($id);
        $coursecategory->update($request->all());
        

        return $coursecategory;
    }

    public function store(StoreCoursecategoriesRequest $request)
    {
        $coursecategory = Coursecategory::create($request->all());
        

        return $coursecategory;
    }

    public function destroy($id)
    {
        $coursecategory = Coursecategory::findOrFail($id);
        $coursecategory->delete();
        return '';
    }
}
