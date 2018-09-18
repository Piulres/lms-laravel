<?php

namespace App\Http\Controllers\Api\V1;

use App\Trailtag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailtagsRequest;
use App\Http\Requests\Admin\UpdateTrailtagsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailtagsController extends Controller
{
    public function index()
    {
        return Trailtag::all();
    }

    public function show($id)
    {
        return Trailtag::findOrFail($id);
    }

    public function update(UpdateTrailtagsRequest $request, $id)
    {
        $trailtag = Trailtag::findOrFail($id);
        $trailtag->update($request->all());
        

        return $trailtag;
    }

    public function store(StoreTrailtagsRequest $request)
    {
        $trailtag = Trailtag::create($request->all());
        

        return $trailtag;
    }

    public function destroy($id)
    {
        $trailtag = Trailtag::findOrFail($id);
        $trailtag->delete();
        return '';
    }
}
