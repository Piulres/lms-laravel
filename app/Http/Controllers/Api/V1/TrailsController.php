<?php

namespace App\Http\Controllers\Api\V1;

use App\Trail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailsRequest;
use App\Http\Requests\Admin\UpdateTrailsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailsController extends Controller
{
    public function index()
    {
        return Trail::all();
    }

    public function show($id)
    {
        return Trail::findOrFail($id);
    }

    public function update(UpdateTrailsRequest $request, $id)
    {
        $trail = Trail::findOrFail($id);
        $trail->update($request->all());
        

        return $trail;
    }

    public function store(StoreTrailsRequest $request)
    {
        $trail = Trail::create($request->all());
        

        return $trail;
    }

    public function destroy($id)
    {
        $trail = Trail::findOrFail($id);
        $trail->delete();
        return '';
    }
}
