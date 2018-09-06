<?php

namespace App\Http\Controllers\Admin;

use App\InternalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInternalNotificationsRequest;
use App\Http\Requests\Admin\UpdateInternalNotificationsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InternalNotificationsController extends Controller
{
    /**
     * Display a listing of InternalNotification.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('internal_notification_access')) {
            return abort(401);
        }


                $internal_notifications = InternalNotification::all();

        return view('admin.internal_notifications.index', compact('internal_notifications'));
    }

    /**
     * Show the form for creating new InternalNotification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('internal_notification_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');


        return view('admin.internal_notifications.create', compact('users'));
    }

    /**
     * Store a newly created InternalNotification in storage.
     *
     * @param  \App\Http\Requests\StoreInternalNotificationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInternalNotificationsRequest $request)
    {
        if (! Gate::allows('internal_notification_create')) {
            return abort(401);
        }
        $internal_notification = InternalNotification::create($request->all());
        $internal_notification->users()->sync(array_filter((array)$request->input('users')));



        return redirect()->route('admin.internal_notifications.index');
    }


    /**
     * Show the form for editing InternalNotification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('internal_notification_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');


        $internal_notification = InternalNotification::findOrFail($id);

        return view('admin.internal_notifications.edit', compact('internal_notification', 'users'));
    }

    /**
     * Update InternalNotification in storage.
     *
     * @param  \App\Http\Requests\UpdateInternalNotificationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInternalNotificationsRequest $request, $id)
    {
        if (! Gate::allows('internal_notification_edit')) {
            return abort(401);
        }
        $internal_notification = InternalNotification::findOrFail($id);
        $internal_notification->update($request->all());
        $internal_notification->users()->sync(array_filter((array)$request->input('users')));



        return redirect()->route('admin.internal_notifications.index');
    }


    /**
     * Display InternalNotification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('internal_notification_view')) {
            return abort(401);
        }
        $internal_notification = InternalNotification::findOrFail($id);

        return view('admin.internal_notifications.show', compact('internal_notification'));
    }


    /**
     * Remove InternalNotification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('internal_notification_delete')) {
            return abort(401);
        }
        $internal_notification = InternalNotification::findOrFail($id);
        $internal_notification->delete();

        return redirect()->route('admin.internal_notifications.index');
    }

    /**
     * Delete all selected InternalNotification at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('internal_notification_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = InternalNotification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    /**
     * Set all user notifications as read
     */
    public function read()
    {
        DB::table('internal_notification_user')
            ->where('user_id', Auth::id())
            ->update(['read_at' => Carbon::now()]);
    }
}
