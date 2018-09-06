<?php

namespace App\Http\Controllers\Api\V1;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeamsRequest;
use App\Http\Requests\Admin\UpdateTeamsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TeamsController extends Controller
{
    public function index()
    {
        return Team::all();
    }

    public function show($id)
    {
        return Team::findOrFail($id);
    }

    public function update(UpdateTeamsRequest $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($request->all());
        

        return $team;
    }

    public function store(StoreTeamsRequest $request)
    {
        $team = Team::create($request->all());
        

        return $team;
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        return '';
    }
}
