<?php

namespace App\Http\Controllers\Api\V1;

use App\Traildatum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTraildatasRequest;
use App\Http\Requests\Admin\UpdateTraildatasRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TraildatasController extends Controller
{
    public function index()
    {
        return Traildatum::all();
    }

    public function show($id)
    {
        return Traildatum::findOrFail($id);
    }

    public function update(UpdateTraildatasRequest $request, $id)
    {
        $traildatum = Traildatum::findOrFail($id);
        $traildatum->update($request->all());
        

        return $traildatum;
    }

    public function store(StoreTraildatasRequest $request)
    {
        $traildatum = Traildatum::create($request->all());
        

        return $traildatum;
    }

    public function destroy($id)
    {
        $traildatum = Traildatum::findOrFail($id);
        $traildatum->delete();
        return '';
    }
}
