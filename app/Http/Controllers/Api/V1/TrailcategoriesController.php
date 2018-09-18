<?php

namespace App\Http\Controllers\Api\V1;

use App\Trailcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailcategoriesRequest;
use App\Http\Requests\Admin\UpdateTrailcategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailcategoriesController extends Controller
{
    public function index()
    {
        return Trailcategory::all();
    }

    public function show($id)
    {
        return Trailcategory::findOrFail($id);
    }

    public function update(UpdateTrailcategoriesRequest $request, $id)
    {
        $trailcategory = Trailcategory::findOrFail($id);
        $trailcategory->update($request->all());
        

        return $trailcategory;
    }

    public function store(StoreTrailcategoriesRequest $request)
    {
        $trailcategory = Trailcategory::create($request->all());
        

        return $trailcategory;
    }

    public function destroy($id)
    {
        $trailcategory = Trailcategory::findOrFail($id);
        $trailcategory->delete();
        return '';
    }
}
