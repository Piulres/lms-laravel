<?php

namespace App\Http\Controllers\Api\V1;

use App\Coursescategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursescategoriesRequest;
use App\Http\Requests\Admin\UpdateCoursescategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursescategoriesController extends Controller
{
    public function index()
    {
        return Coursescategory::all();
    }

    public function show($id)
    {
        return Coursescategory::findOrFail($id);
    }

    public function update(UpdateCoursescategoriesRequest $request, $id)
    {
        $coursescategory = Coursescategory::findOrFail($id);
        $coursescategory->update($request->all());
        

        return $coursescategory;
    }

    public function store(StoreCoursescategoriesRequest $request)
    {
        $coursescategory = Coursescategory::create($request->all());
        

        return $coursescategory;
    }

    public function destroy($id)
    {
        $coursescategory = Coursescategory::findOrFail($id);
        $coursescategory->delete();
        return '';
    }
}
