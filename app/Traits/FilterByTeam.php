<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait FilterByTeam
{
    protected static function bootFilterByTeam()
    {
        if (! app()->runningInConsole()) {
            $currentUser = Auth::user();
            if (!$currentUser) {
                return;
            }
            $canSeeAllRecordsRoleId = config('app_service.can_see_all_records_role_id');
            $modelName = class_basename(self::class);

            if (!is_null($canSeeAllRecordsRoleId) && in_array($canSeeAllRecordsRoleId, $currentUser->role->pluck('id')->toArray())) {
                if (Session::get($modelName . '.filter', 'all') == 'my') {
                    Session::put($modelName . '.filter', 'my');
                    $addScope = true;
                } else {
                    Session::put($modelName . '.filter', 'all');
                    $addScope = false;
                }
            } else {
                $addScope = true;
            }

            if ($addScope) {
                if (((new self)->getTable()) == 'teams') {
                    static::addGlobalScope('team_id', function (Builder $builder) use ($currentUser) {
                        $builder->where('team_id', $currentUser->team_id)
                            ->orWhere('id', $currentUser->team_id);
                    });
                } else {
                    static::addGlobalScope('team_id', function (Builder $builder) use ($currentUser) {
                        $builder->where('team_id', $currentUser->team_id);
                    });
                }
            }
        }
    }
}
