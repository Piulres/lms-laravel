<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App
 * @property string $title
*/
class Permission extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Permission::observe(new \App\Observers\UserActionsObserver);
    }
    
}
