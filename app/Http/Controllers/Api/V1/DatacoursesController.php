<?php

namespace App\Http\Controllers\Api\V1;

use App\Datacourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatacoursesRequest;
use App\Http\Requests\Admin\UpdateDatacoursesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatacoursesController extends Controller
{
    public function index()
    {
        return Datacourse::all();
    }

    public function show($id)
    {
        return Datacourse::findOrFail($id);
    }

    public function update(UpdateDatacoursesRequest $request, $id)
    {
        $datacourse = Datacourse::findOrFail($id);
        $datacourse->update($request->all());
        

        return $datacourse;
    }

    public function store(StoreDatacoursesRequest $request)
    {
        $datacourse = Datacourse::create($request->all());
        

        return $datacourse;
    }

    public function destroy($id)
    {
        $datacourse = Datacourse::findOrFail($id);
        $datacourse->delete();
        return '';
    }
}
