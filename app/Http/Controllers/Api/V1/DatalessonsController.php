<?php

namespace App\Http\Controllers\Api\V1;

use App\Datalesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDatalessonsRequest;
use App\Http\Requests\Admin\UpdateDatalessonsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DatalessonsController extends Controller
{
    public function index()
    {
        return Datalesson::all();
    }

    public function show($id)
    {
        return Datalesson::findOrFail($id);
    }

    public function update(UpdateDatalessonsRequest $request, $id)
    {
        $datalesson = Datalesson::findOrFail($id);
        $datalesson->update($request->all());
        

        return $datalesson;
    }

    public function store(StoreDatalessonsRequest $request)
    {
        $datalesson = Datalesson::create($request->all());
        

        return $datalesson;
    }

    public function destroy($id)
    {
        $datalesson = Datalesson::findOrFail($id);
        $datalesson->delete();
        return '';
    }
}
