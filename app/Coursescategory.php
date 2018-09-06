<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coursescategory
 *
 * @package App
 * @property string $title
*/
class Coursescategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Coursescategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
