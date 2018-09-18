<?php

namespace App\Http\Controllers\Api\V1;

use App\Datatrail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatatrailsRequest;
use App\Http\Requests\Admin\UpdateDatatrailsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatatrailsController extends Controller
{
    public function index()
    {
        return Datatrail::all();
    }

    public function show($id)
    {
        return Datatrail::findOrFail($id);
    }

    public function update(UpdateDatatrailsRequest $request, $id)
    {
        $datatrail = Datatrail::findOrFail($id);
        $datatrail->update($request->all());
        

        return $datatrail;
    }

    public function store(StoreDatatrailsRequest $request)
    {
        $datatrail = Datatrail::create($request->all());
        

        return $datatrail;
    }

    public function destroy($id)
    {
        $datatrail = Datatrail::findOrFail($id);
        $datatrail->delete();
        return '';
    }
}
