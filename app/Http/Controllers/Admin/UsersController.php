<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = User::query();
            $query->with("role");
            $query->with("team");
            $template = 'actionsTemplate';
            
            $query->select([
                'users.id',
                'users.name',
                'users.lastname',
                'users.website',
                'users.email',
                'users.password',
                'users.avatar',
                'users.remember_token',
                'users.team_id',
                'users.approved',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_';
                $routeKey = 'admin.users';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('lastname', function ($row) {
                return $row->lastname ? $row->lastname : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('password', function ($row) {
                return '---';
            });
            $table->editColumn('avatar', function ($row) {
                if($row->avatar) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->avatar) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->avatar) .'"/>'; };
            });
            $table->editColumn('remember_token', function ($row) {
                return $row->remember_token ? $row->remember_token : '';
            });
            $table->editColumn('role.title', function ($row) {
                if(count($row->role) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->role->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('team.name', function ($row) {
                return $row->team ? $row->team->name : '';
            });
            $table->editColumn('approved', function ($row) {
                return \Form::checkbox("approved", 1, $row->approved == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','avatar','role.title','approved']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.users.index', compact('generals'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $generals = \App\General::get();

        return view('admin.users.create', compact('roles', 'teams', 'generals'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $user = User::create($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $user = User::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.users.edit', compact('user', 'roles', 'teams', 'generals'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$user_actions = \App\UserAction::where('user_id', $id)->get();$internal_notifications = \App\InternalNotification::whereHas('users',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$datatrails = \App\Datatrail::where('user_id', $id)->get();$datacourses = \App\Datacourse::where('user_id', $id)->get();$courses = \App\Course::whereHas('instructor',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $user = User::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.users.show', compact('user', 'user_actions', 'internal_notifications', 'datatrails', 'datacourses', 'courses', 'generals'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
