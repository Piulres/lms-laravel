<?php

namespace App\Http\Controllers\Api\V1;

use App\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGeneralsRequest;
use App\Http\Requests\Admin\UpdateGeneralsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class GeneralsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return General::all();
    }

    public function show($id)
    {
        return General::findOrFail($id);
    }

    public function update(UpdateGeneralsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $general = General::findOrFail($id);
        $general->update($request->all());
        

        return $general;
    }

    public function store(StoreGeneralsRequest $request)
    {
        $request = $this->saveFiles($request);
        $general = General::create($request->all());
        

        return $general;
    }

    public function destroy($id)
    {
        $general = General::findOrFail($id);
        $general->delete();
        return '';
    }
}
