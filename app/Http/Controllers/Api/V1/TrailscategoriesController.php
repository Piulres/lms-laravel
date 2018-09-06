<?php

namespace App\Http\Controllers\Api\V1;

use App\Trailscategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailscategoriesRequest;
use App\Http\Requests\Admin\UpdateTrailscategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailscategoriesController extends Controller
{
    public function index()
    {
        return Trailscategory::all();
    }

    public function show($id)
    {
        return Trailscategory::findOrFail($id);
    }

    public function update(UpdateTrailscategoriesRequest $request, $id)
    {
        $trailscategory = Trailscategory::findOrFail($id);
        $trailscategory->update($request->all());
        

        return $trailscategory;
    }

    public function store(StoreTrailscategoriesRequest $request)
    {
        $trailscategory = Trailscategory::create($request->all());
        

        return $trailscategory;
    }

    public function destroy($id)
    {
        $trailscategory = Trailscategory::findOrFail($id);
        $trailscategory->delete();
        return '';
    }
}
